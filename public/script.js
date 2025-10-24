// function preview image
function previewImage(element) {
    const mainImage = document.getElementById("mainImage");
    mainImage.src = element.src;
}

// function handle submit & sweetalert
function handleSubmit(e) {
    e.preventDefault(); // Stop reload

    const checkinDate = document.getElementById("checkinDate").value;

    if (!checkinDate) {
        Swal.fire({
            icon: "warning",
            title: "Tanggal belum dipilih!",
            text: "Yuk pilih dulu tanggal check-in-nya.",
        });
        return;
    }

    // Konfirmasi dulu sebelum lanjut
    Swal.fire({
        title: "Konfirmasi Pesanan",
        text: `Pesan kost dengan tanggal check-in: ${checkinDate}?`,
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya, pesan sekarang!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika user yakin → kirim pesanan
            Swal.fire({
                title: "Pesanan Terkirim!",
                text: "Kami akan segera menghubungi kamu.",
                icon: "success",
                confirmButtonText: "Cek Pesanan"
            }).then(() => {
                // Redirect ke halaman pesanan
                window.location.href = "order.html";
            });

            // Optional reset form
            document.getElementById("formPesan").reset();
        }
    });
}

// function untuk menampilkan detail pesanan di modal
function lihatDetail(nama, tanggal, alamat, status, kode) {
    document.getElementById("modalNamaKost").textContent = nama;
    document.getElementById("modalTanggal").textContent = tanggal;
    document.getElementById("modalAlamat").textContent = alamat;
    document.getElementById("modalStatus").textContent = status;
    document.getElementById("modalKode").textContent = kode;

    const modal = new bootstrap.Modal(document.getElementById('detailModal'));
    modal.show();
}

function salinKode() {
    const kode = document.getElementById("modalKode").textContent;
    navigator.clipboard.writeText(kode).then(() => {
        Swal.fire({
            icon: 'success',
            title: 'Kode disalin!',
            text: `Kode booking ${kode} sudah tersalin.`,
            timer: 1500,
            showConfirmButton: false
        });
    });
}

function bukaUploadModal(nama, tanggal, kode) {
    document.getElementById("uploadNamaKost").textContent = nama;
    document.getElementById("uploadTanggal").textContent = tanggal;
    document.getElementById("uploadKode").textContent = kode;

    const modal = new bootstrap.Modal(document.getElementById('uploadModal'));
    modal.show();
}

// Simulasi kirim form upload
let currentRowButton = null; // Untuk simpan tombol bayar yang terakhir diklik

function bukaUploadModal(nama, tanggal, kode, btn) {
    currentRowButton = btn;

    // document.getElementById("uploadNamaKost").textContent = nama;
    // document.getElementById("uploadTanggal").textContent = tanggal;
    // document.getElementById("uploadKode").textContent = kode;

    // contoh nominal tetap, atau nanti bisa tarik dari data
    document.getElementById("uploadNominal").textContent = "Rp 750.000";

    const modal = new bootstrap.Modal(document.getElementById('uploadModal'));
    modal.show();
}



// Event submit form upload
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("uploadForm").addEventListener("submit", function (e) {
        e.preventDefault();

        const file = document.getElementById("buktiBayar").files[0];

        if (!file) {
            Swal.fire("Oops!", "Harap pilih file bukti bayar!", "warning");
            return;
        }

        // Simulasi pengiriman berhasil
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Bukti pembayaran telah dikirim.',
            timer: 2000,
            showConfirmButton: false
        });

        // Tutup modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('uploadModal'));
        modal.hide();

        // Reset form
        this.reset();

        // Ubah status dan hapus tombol bayar
        if (currentRowButton) {
            const row = currentRowButton.closest("tr"); // cari <tr>
            const statusCell = row.querySelector("td:nth-child(5)"); // kolom status
            statusCell.innerHTML = `<span class="badge bg-info text-dark">Dalam Proses</span>`;

            currentRowButton.remove(); // hapus tombol bayar
            currentRowButton = null;  // reset variabel
        }
    });
});

function batalkanPesanan(btn) {
    Swal.fire({
        title: 'Yakin ingin batalkan pesanan?',
        text: "Tindakan ini tidak bisa dibatalkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, batalkan!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Ganti status jadi 'Dibatalkan'
            const row = btn.closest("tr");
            const statusCell = row.querySelector("td:nth-child(5)");
            statusCell.innerHTML = `<span class="badge bg-danger">Dibatalkan</span>`;

            // Hapus semua tombol aksi biar gak bisa klik Bayar/Lihat Detail lagi (optional)
            const aksiCell = row.querySelector("td:nth-child(6)");
            aksiCell.innerHTML = `<button class="btn btn-secondary btn-sm" disabled>Dibatalkan</button>`;

            // SweetAlert konfirmasi sukses
            Swal.fire({
                icon: 'success',
                title: 'Dibatalkan!',
                text: 'Pesananmu telah dibatalkan.',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
}



