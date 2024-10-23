<script>
    $(document).ready(function() {
        $('#myForm').submit(function(event) {
            let isValid = true;

            $('input[name="no_resi[]"]').each(function() {
                if ($(this).val() == "") {
                    $(this).addClass('is-invalid');
                    alert("Nomor Resi harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="tgl_transaksi[]"]').each(function() {
                const tanggalSekarang = new Date().toISOString().split('T')[0];
                const tglTransaksi = $(this).val();
                const tanggalSekarangDate = new Date();
                const tanggalTransaksiDate = new Date(tglTransaksi);

                const diff = new Date(tanggalSekarang) - new Date(tglTransaksi);

                const jarakHari = Math.abs(Math.round(diff / (1000 * 60 * 60 * 24)));

                if (jarakHari > 7) {
                    $(this).addClass('is-invalid');
                    alert("Tanggal transaksi tidak boleh mundur lebih dari 7 hari!");
                    isValid = false;
                    return false;
                }

                if ($(this).val() == "") {
                    $(this).addClass('is-invalid');
                    alert("Tanggal Transaksi harus diisi");
                    isValid = false;
                    return false;
                }

                if (tanggalTransaksiDate.getFullYear() !== tanggalSekarangDate.getFullYear()) {
                    $(this).addClass('is-invalid');
                    alert("Tahun transaksi harus sama dengan tahun saat ini!");
                    isValid = false;
                    return false;
                }
            });
            $('select[name="input_by[]"]').each(function() {
                if ($(this).val() == "") {
                    $(this).addClass('custom-select2');
                    alert("Diinput Oleh harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('select[name="kode_customer[]"]').each(function() {
                if ($(this).val() == "") {
                    $(this).addClass('custom-select2');
                    alert("Kode Customer harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="nama_pengirim[]"]').each(function() {
                if ($(this).val() == "") {
                    $(this).addClass('is-invalid');
                    alert("Nama pengirim harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="nama_penerima[]"]').each(function() {
                if ($(this).val() == "") {
                    $(this).addClass('is-invalid');
                    alert("Nama penerima harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="kota_tujuan[]"]').each(function() {
                if ($(this).val() == "") {
                    $(this).addClass('is-invalid');
                    alert("Kota Tujuan harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="no_hp_pengirim[]"]').each(function() {
                if ($(this).val() == "") {
                    $(this).addClass('is-invalid');
                    alert("Nomor HP pengirim harus diisi");
                    isValid = false;
                    return false;
                }
                if (!/^62[0-9]{9,14}$/.test($(this).val())) {
                    $(this).addClass('is-invalid');
                    alert("Format No Hp Pengirim Tidak Sesuai");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="no_hp_penerima[]"]').each(function() {
                if ($(this).val() == "") {
                    $(this).addClass('is-invalid');
                    alert("Nomor HP penerima harus diisi");
                    isValid = false;
                    return false;
                }
                if (!/^62[0-9]{9,14}$/.test($(this).val())) {
                    $(this).addClass('is-invalid');
                    alert("Format No Hp Penerima Tidak Sesuai");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="berat_barang[]"]').each(function() {
                if ($(this).val() == "") {
                    $(this).addClass('is-invalid');
                    alert("Berat Barang harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="ongkir[]"]').each(function(index) {
                if ($(this).val() == "") {
                    $(this).addClass('is-invalid');
                    alert("Ongkir harus diisi");
                    isValid = false;
                    return false;
                }

                let ongkir = parseFloat($(this).val());

                let jumlahPembayaran = parseFloat($('input[name="jumlah_pembayaran[]"]').eq(index).val()) || 0;
                let jumlahPembayaran2 = parseFloat($('input[name="jumlah_pembayaran_2[]"]').eq(index).val()) || 0;

                if (jumlahPembayaran + jumlahPembayaran2 > ongkir) {
                    $('input[name="jumlah_pembayaran[]"]').eq(index).addClass('is-invalid');
                    $('input[name="jumlah_pembayaran_2[]"]').eq(index).addClass('is-invalid');
                    alert("Jumlah Pembayaran 1 dan 2 melebihi Ongkir!");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="komisi[]"]').each(function() {
                if ($(this).val() == "") {
                    $(this).addClass('is-invalid');
                    alert("Komisi harus diisi");
                    isValid = false;
                    return false;
                }              
            });
            $('select[name="metode_pembayaran[]"]').each(function(index) {
                // if ($(this).val() == "") {
                //     $(this).addClass('is-invalid');
                //     alert("Metode Pembayaran harus diisi");
                //     isValid = false;
                //     return false;
                // }

                if ($(this).val().toLowerCase() == "transfer") {
                    let correspondingBuktiInput = $('input[name="bukti_pembayaran[]"]').eq(index);
                    let correspondingBankInput = $('select[name="bank[]"]').eq(index);
                    if (correspondingBankInput.val() == "") {
                        correspondingBankInput.addClass('custom-select2');
                        alert("Bank harus diisi jika metode pembayaran adalah transfer");
                        isValid = false;
                        return false; 
                    }
                }
                
                if ($(this).val().toLowerCase() == "kredit") {
                    let correspondingKodeInput = $('select[name="kode_customer[]"]').eq(index);
                    if (correspondingKodeInput.val() == "General") {
                        correspondingKodeInput.addClass('custom-select2');
                        alert("Metode pembayaran kredit hanya berlaku untuk customer terdaftar atau kosongkan kolom customer!");
                        isValid = false;
                        return false; 
                    }
                }
                
                // if ($(this).val().toLowerCase() != "tunai" && $(this).val().toLowerCase() != "kredit") {
                //     let correspondingBuktiInput = $('input[name="bukti_pembayaran[]"]').eq(index);
                //     if (correspondingBuktiInput.val() == "") {
                //         correspondingBuktiInput.addClass('is-invalid');
                //         alert("Bukti Pembayaran harus diisi jika metode pembayaran bukan tunai");
                //         isValid = false;
                //         return false; 
                //     }
                // }
            });
            
            $('select[name="metode_pembayaran_2[]"]').each(function(index) {

                if ($(this).val().toLowerCase() == "transfer") {
                    let correspondingBankInput = $('select[name="bank_2[]"]').eq(index);
                    if (correspondingBankInput.val() == "") {
                        correspondingBankInput.addClass('custom-select2');
                        alert("Bank harus diisi jika metode pembayaran adalah transfer");
                        isValid = false;
                        return false; 
                    }
                }
                
                if ($(this).val().toLowerCase() == "kredit") {
                    let correspondingKodeInput = $('select[name="kode_customer[]"]').eq(index);
                    if (correspondingKodeInput.val() == "General") {
                        correspondingKodeInput.addClass('custom-select2');
                        alert("Metode pembayaran kredit hanya berlaku untuk customer terdaftar atau kosongkan kolom customer!");
                        isValid = false;
                        return false; 
                    }
                }
            });

            $('input[name="jenis_pengiriman[]"]').each(function() {
                if ($(this).val() == "") {
                    $(this).addClass('is-invalid');
                    alert("Jenis Pengiriman harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('select[name="bawa_sendiri[]"]').each(function() {
                if ($(this).val() == "") {
                    $(this).addClass('custom-select2');
                    alert("Bawa Sendiri harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('select[name="status_pengiriman[]"]').each(function() {
                if ($(this).val() == "") {
                    $(this).addClass('custom-select2');
                    alert("Status Pengiriman harus diisi");
                    isValid = false;
                    return false;
                }
            });

            if (!isValid) {
                event.preventDefault(); // Mencegah form terkirim
            }
        });
    })
</script>