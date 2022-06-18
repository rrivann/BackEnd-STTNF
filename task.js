/**
 * Fungsi untuk menampilkan hasil download
 * @param {string} result - Nama file yang didownload
 */
function showDownload(result) {
  console.log('Download selesai');
  console.log('Hasil Download: ' + result);
}

/**
 * Fungsi untuk download file
 * @param {function} callback - Function callback show
 */
function download(callShowDownload) {
  return new Promise((resolve, reject) => {
    setTimeout(function () {
      const result = 'windows-10.exe';
      callShowDownload(result);
    }, 3000);
  });
}

const main = async () => {
  await download(showDownload);
};

main();
/**
 * TODO:
 * - Refactor callback ke Promise atau Async Await
 * - Refactor function ke ES6 Arrow Function
 * - Refactor string ke ES6 Template Literals
 */
