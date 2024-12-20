// Import jQuery terlebih dahulu
import $ from 'jquery';
window.$ = window.jQuery = $;  // Tentukan `$` dan `jQuery` pada objek `window`


// Import Bootstrap (Sudah menyertakan semua dependensi)
import 'bootstrap';

// Import Summernote
import 'summernote/dist/summernote-lite.min.js';
import 'summernote/dist/summernote-lite.min.css';

$(document).ready(function() {
    $('.summernote').summernote({
        height: 200,
        callbacks: {
            onPaste: function(e) {
                e.preventDefault();
                var text = (e.originalEvent || e).clipboardData.getData('text/plain');
                document.execCommand('insertText', false, text); // Hanya tempel teks biasa
            },
            onInit: function() {
                $('.note-editable').css('font-size', '14px'); // Atur ukuran font default
            }
        }
    });
});

// Import file lokal lainnya (hanya jika dibutuhkan)

