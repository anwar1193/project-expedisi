<script>
    $(document).ready(function() {
        $('#myForm').submit(function(event) {
            let isValid = true;

            $('input[name="no_resi[]"]').each(function() {
                if ($(this).val() == "") {
                    alert("Nomor Resi harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="tgl_transaksi[]"]').each(function() {
                if ($(this).val() == "") {
                    alert("Tanggal Transaksi harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="input_by[]"]').each(function() {
                if ($(this).val() == "") {
                    alert("Diinput Oleh harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="nama_pengirim[]"]').each(function() {
                if ($(this).val() == "") {
                    alert("Nama pengirim harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="nama_penerima[]"]').each(function() {
                if ($(this).val() == "") {
                    alert("Nama penerima harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="kota_tujuan[]"]').each(function() {
                if ($(this).val() == "") {
                    alert("Kota Tujuan harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="no_hp_pengirim[]"]').each(function() {
                if ($(this).val() == "") {
                    alert("Nomor HP pengirim harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="no_hp_penerima[]"]').each(function() {
                if ($(this).val() == "") {
                    alert("Nomor HP penerima harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="berat_barang[]"]').each(function() {
                if ($(this).val() == "") {
                    alert("Berat Barang harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="ongkir[]"]').each(function() {
                if ($(this).val() == "") {
                    alert("Ongkir harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="komisi[]"]').each(function() {
                if ($(this).val() == "") {
                    alert("Komisi harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('select[name="metode_pembayaran[]"]').each(function(index) {
                if ($(this).val() == "") {
                    alert("Metode Pembayaran harus diisi");
                    isValid = false;
                    return false; // 
                }

                if ($(this).val().toLowerCase() == "transfer") {
                    let correspondingBuktiInput = $('input[name="bukti_pembayaran[]"]').eq(index);
                    let correspondingBankInput = $('select[name="bank[]"]').eq(index);
                    if (correspondingBankInput.val() == "") {
                        alert("Bank harus diisi jika metode pembayaran adalah transfer");
                        isValid = false;
                        return false; 
                    } else if (correspondingBuktiInput.val() == "") {
                        alert("Bukti Pembayaran harus diisi jika metode pembayaran adalah transfer");
                        isValid = false;
                        return false; 
                    }
                }
            });
            $('input[name="jenis_pengiriman[]"]').each(function() {
                if ($(this).val() == "") {
                    alert("Jenis Pengiriman harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="bawa_sendiri[]"]').each(function() {
                if ($(this).val() == "") {
                    alert("Bawa Sendiri harus diisi");
                    isValid = false;
                    return false;
                }
            });
            $('input[name="status_pengiriman[]"]').each(function() {
                if ($(this).val() == "") {
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