(function () {
	'use strict';

	var sessionKey = 'catScreenshotSession';
	var databaseName = 'catScreenshotDirectory';
	var interval = 10000;
	var busy = false;

	function openDatabase() {
		return new Promise(function (resolve, reject) {
			var request = indexedDB.open(databaseName, 1);

			request.onupgradeneeded = function () {
				request.result.createObjectStore('directories');
			};
			request.onsuccess = function () { resolve(request.result); };
			request.onerror = function () { reject(request.error); };
		});
	}

	async function storeDirectory(handle) {
		var database = await openDatabase();
		await new Promise(function (resolve, reject) {
			var transaction = database.transaction('directories', 'readwrite');
			transaction.objectStore('directories').put(handle, 'foto');
			transaction.oncomplete = resolve;
			transaction.onerror = function () { reject(transaction.error); };
		});
		database.close();
	}

	async function loadDirectory() {
		var database = await openDatabase();
		var handle = await new Promise(function (resolve, reject) {
			var request = database.transaction('directories').objectStore('directories').get('foto');
			request.onsuccess = function () { resolve(request.result); };
			request.onerror = function () { reject(request.error); };
		});
		database.close();
		return handle;
	}

	function readSession() {
		try {
			return JSON.parse(sessionStorage.getItem(sessionKey));
		} catch (error) {
			return null;
		}
	}

	function stopCapture() {
		sessionStorage.removeItem(sessionKey);
	}

	function makeFilename() {
		var registration = document.querySelector('#no_registrasi');
		var participant = registration ? registration.value.trim().replace(/[^a-zA-Z0-9_-]/g, '_') : 'peserta';
		var timestamp = new Date().toISOString().replace(/[:.]/g, '-');
		return (participant || 'peserta') + '_' + timestamp + '.png';
	}

	async function saveScreenshot(directory) {
		if (busy) return;
		if (typeof window.html2canvas !== 'function') {
			throw new Error('Pustaka screenshot tidak tersedia.');
		}
		busy = true;

		try {
			var canvas = await window.html2canvas(document.documentElement, {
				logging: false,
				useCORS: true,
				scale: window.devicePixelRatio || 1
			});
			var blob = await new Promise(function (resolve) {
				canvas.toBlob(resolve, 'image/png');
			});
			if (!blob) throw new Error('Gagal membuat gambar screenshot.');

			var file = await directory.getFileHandle(makeFilename(), { create: true });
			var writer = await file.createWritable();
			await writer.write(blob);
			await writer.close();
		} finally {
			busy = false;
		}
	}

	async function runCapture() {
		var session = readSession();
		if (!session || !session.active) return;

		var directory;
		try {
			directory = await loadDirectory();
			if (!directory) throw new Error('Folder screenshot tidak ditemukan.');
		} catch (error) {
			console.error('Screenshot otomatis dihentikan:', error);
			stopCapture();
			return;
		}

		var isResultPage = Boolean(document.querySelector('#hasil-peserta'));

		async function captureAndContinue() {
			try {
				await saveScreenshot(directory);
			} catch (error) {
				console.error('Screenshot otomatis gagal disimpan:', error);
				stopCapture();
				return;
			}

			if (isResultPage) {
				stopCapture();
				return;
			}

			var currentSession = readSession();
			if (!currentSession || !currentSession.active) return;
			currentSession.nextAt = Date.now() + interval;
			sessionStorage.setItem(sessionKey, JSON.stringify(currentSession));
			window.setTimeout(captureAndContinue, interval);
		}

		if (isResultPage) {
			await captureAndContinue();
			return;
		}

		var delay = Math.max(0, (session.nextAt || Date.now() + interval) - Date.now());
		window.setTimeout(captureAndContinue, delay);
	}

	var daftarLink = document.querySelector('a[href*="registrasi"]');
	if (daftarLink && !readSession()) {
		daftarLink.addEventListener('click', async function (event) {
			if (!window.isSecureContext || !window.showDirectoryPicker || !window.indexedDB) {
				window.alert('Screenshot otomatis memerlukan Edge atau Chrome versi terbaru dan situs HTTPS atau localhost.');
				return;
			}

			event.preventDefault();
			try {
				var documents = await window.showDirectoryPicker({
					id: 'cat-amayogyakarta-screenshots',
					mode: 'readwrite',
					startIn: 'documents'
				});
				var foto = await documents.getDirectoryHandle('foto', { create: true });
				await storeDirectory(foto);
				sessionStorage.setItem(sessionKey, JSON.stringify({
					active: true,
					nextAt: Date.now() + interval
				}));
				window.location.assign(daftarLink.href);
			} catch (error) {
				if (error.name !== 'AbortError') {
					console.error('Folder screenshot tidak dapat disiapkan:', error);
					window.alert('Folder screenshot tidak dapat disiapkan. Pastikan Anda memilih folder Documents.');
				}
			}
		});
	}

	runCapture();
}());