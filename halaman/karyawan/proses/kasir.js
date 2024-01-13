let daftarPesanan = []

const tidakAdaDaftarPesanan = document.getElementById('tidakAdaDaftarPesanan')
const buatPesananBtn = document.getElementById('buatPesananBtn');

function tambahMenu(id, nama, total, gambar, satuan) {
    tidakAdaDaftarPesanan.style.display = 'none'
    daftarPesanan.push(
        [id, 1, total, nama, satuan]
    )
    
    const cardPesananGroup = document.querySelector('#cardPesananGroup')

    const cardPesananHTML = 
    `
    <div class="card-pesanan">
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <img width="65px" height="65px" style="object-fit: cover; border-radius: 12px;" src="../../gambar/barang/${gambar}" alt="">
            <div>
                <h3 style="color: red;">${nama}</h3>
                <h4 style="white-space: nowrap; font-weight: 500;">Rp. <span>${formatRupiah(total)}</span></h4>
            </div>
        </div>
        <div class="number-input">
          <button onclick="this.parentNode.querySelector('input[type=number]').stepDown(); kurangBarang(this, ${total})" style="border-top-left-radius: 8px; border-end-start-radius: 8px;"><h3>-</h3></button>
          <input readonly min="1" value="1" placeholder="1" type="number">
          <button onclick="this.parentNode.querySelector('input[type=number]').stepUp(); tambahBarang(this, ${total})" style="border-top-right-radius: 8px; border-end-end-radius: 8px;"><h3>+</h3></button>
        </div>
        <button id='hapusDaftarMenuBtn' onclick="hapusMenu(this)">
            <svg style="width: 1.5rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>
        </button>
    </div>
    `

    cardPesananGroup.insertAdjacentHTML('beforeend', cardPesananHTML)

    hitungSubTotal()

    const totalItem = document.getElementById('totalItem')
    totalItem.textContent = daftarPesanan.length

    
}

function kurangBarang(el, hargaBarang) {
    let indexPesanan = Array.from(el.parentElement.parentElement.parentElement.children).indexOf(el.parentElement.parentElement) - 1
    let jumlahPesanan = el.parentElement.children[1].value

    daftarPesanan[indexPesanan][1] = parseInt(jumlahPesanan)
    daftarPesanan[indexPesanan][2] = hargaBarang * jumlahPesanan

    let hargaPesanan = el.parentElement.parentElement.children[0].children[1].children[1].children[0]
    hargaPesanan.textContent = formatRupiah(daftarPesanan[indexPesanan][2])

    hitungSubTotal()
    hitungTotalItem()
    
}
function tambahBarang(el, hargaBarang) {
    let indexPesanan = Array.from(el.parentElement.parentElement.parentElement.children).indexOf(el.parentElement.parentElement) - 1
    let jumlahPesanan = el.parentElement.children[1].value

    daftarPesanan[indexPesanan][1] = parseInt(jumlahPesanan)
    daftarPesanan[indexPesanan][2] = hargaBarang * jumlahPesanan
    
    let hargaPesanan = el.parentElement.parentElement.children[0].children[1].children[1].children[0]
    hargaPesanan.textContent = formatRupiah(daftarPesanan[indexPesanan][2])

    hitungSubTotal()
    hitungTotalItem()
    
}

function hapusMenu(el) {        
    let indexPesanan = Array.from(el.parentElement.parentElement.children).indexOf(el.parentElement) - 1;
    
    el.parentElement.remove()
    daftarPesanan.splice(indexPesanan, 1)
    
    
    hitungSubTotal()
    hitungTotalItem()   
    
    if(tidakAdaDaftarPesanan.parentElement.querySelector('div') == null) { 
        tidakAdaDaftarPesanan.style.display = '' }
    else {
        tidakAdaDaftarPesanan.style.display = 'none';
    } 

    
}


function hitungSubTotal() {
    let subTotal = daftarPesanan.reduce((accumulator, currentValue) => {
        return accumulator + currentValue[2];
    }, 0);
    
    let subTotalText = document.getElementById('subTotal')
    subTotalText.textContent = formatRupiah(subTotal)

    inputTunai(document.getElementById('inputTunai').value)
}
function hitungTotalItem() {
    let totalItem = daftarPesanan.reduce((accumulator, currentValue) => {
        return accumulator + currentValue[1];
    }, 0);
    
    let totalItemText = document.getElementById('totalItem')
    totalItemText.textContent = totalItem
}

function buatPesanan() {
    Swal.fire({
        title: 'Buat Transaksi?',
        text: "Pastikan menu sudah sesuai ya!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result.isConfirmed) {
        // Membuat objek XMLHttpRequest
        var xhr = new XMLHttpRequest();

        // Menyiapkan data yang akan dikirim
        var data = "daftarPesanan=" + encodeURIComponent(JSON.stringify(daftarPesanan)) +
                   "&subTotal=" + encodeURIComponent(parseInt(document.getElementById('subTotal').textContent.replace('.', ''))) +
                   "&totalItem=" + encodeURIComponent(document.getElementById('totalItem').textContent) +
                   "&inputTunai=" + encodeURIComponent(document.getElementById('inputTunai').value) +
                   "&kembali=" + encodeURIComponent(parseInt(document.getElementById('kembali').textContent.replace('Rp. ', '').replace('.', '')))
        
        // Mengatur jenis permintaan dan URL tujuan
        xhr.open("POST", "./proses/insert-transaksi.php", true);

        // Mengatur header untuk memberitahu server bahwa ini adalah permintaan dengan data terkandung
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Menangani perubahan status permintaan
        xhr.onreadystatechange = function () {
            // Cek apakah permintaan telah selesai (status 4) dan berhasil (status 200)
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Proses respons dari server (jika ada)
                Swal.fire(
                    'Berhasil Membuat Transaksi!',
                    'Silahkan cetak struk.',
                    'success'
                  )
            }
        };

        xhr.send(data)

        const cetakStrukBtn = document.getElementById('cetakStrukBtn')
        cetakStrukBtn.classList.remove('disabled-btn')
        cetakStrukBtn.classList.add('blue-btn')

        const tambahMenuBtn = document.querySelectorAll('#tambahMenuBtn')
        tambahMenuBtn.forEach(function(el) {
            el.classList.remove('red-btn')
            el.classList.add('disabled-btn')
        })
        const hapusDaftarMenuBtn = document.querySelectorAll('#hapusDaftarMenuBtn')
        hapusDaftarMenuBtn.forEach(function(el) {
            el.style.background = '#ccc'
            el.style.color = '#666'
        })
        document.getElementById('cardPesananGroup').style.pointerEvents = 'none'

        buatPesananBtn.style.display = 'none'

        document.getElementById('buatTransaksiBaruBtn').style.display = 'block'

        const waktuStruk = document.getElementById('waktuStruk')
        const waktu = new Date()
        waktuStruk.textContent = `${waktu.getFullYear() + '-' + waktu.getMonth() + '-' + waktu.getDate() + ' ' + waktu.getHours() + ':' + waktu.getMinutes() + ':' + waktu.getSeconds() }`

        prosesStruk()
      }}
    )
}

function inputTunai(num) {
    let subTotalText = document.getElementById('subTotal').textContent.replace(/\./g, '');
    let inputTunaiValue = num;
    let kembaliElement = document.getElementById('kembali')

    let hasilKembali = formatRupiah(parseInt(inputTunaiValue) - parseInt(subTotalText))

    // jika daftar pesanan tidak kosong
    if(daftarPesanan.length != 0) {
        if(hasilKembali < 0) {
            kembaliElement.textContent = "Uang Tidak Cukup!"
            kembaliElement.style.color = 'red'

            buatPesananBtn.classList.remove('red-btn')
            buatPesananBtn.classList.add('disabled-btn')
        } else if(hasilKembali > 0) {
            kembaliElement.textContent = 'Rp. ' + hasilKembali
            kembaliElement.style.color = ''

            buatPesananBtn.classList.remove('disabled-btn')
            buatPesananBtn.classList.add('red-btn')
        } else if(hasilKembali == 0) {
            kembaliElement.textContent = "Lunas"
            kembaliElement.style.color = 'blue'

            buatPesananBtn.classList.remove('disabled-btn')
            buatPesananBtn.classList.add('red-btn')
        }
    } 
    // jika daftar pesanan kosong
    else if(daftarPesanan.length == 0) {
        buatPesananBtn.classList.remove('red-btn')
        buatPesananBtn.classList.add('disabled-btn')
    }

    
}

function prosesStruk() {
    const strukDaftarMenu = document.getElementById('strukDaftarMenu')
    const strukQty = document.getElementById('strukQty')
    const strukSatuan = document.getElementById('strukSatuan')
    const strukTotal = document.getElementById('strukTotal')

    strukDaftarMenu.querySelectorAll('span').forEach((span) => {
        span.remove()
    })
    strukQty.querySelectorAll('span').forEach((span) => {
        span.remove()
    })
    strukSatuan.querySelectorAll('span').forEach((span) => {
        span.remove()
    })
    strukTotal.querySelectorAll('span').forEach((span) => {
        span.remove()
    })
    
    daftarPesanan.forEach((pesanan) => {
        strukDaftarMenu.insertAdjacentHTML('beforeend', `<span>${pesanan[3]}</span>`)
        strukQty.insertAdjacentHTML('beforeend', `<span>${pesanan[1]}</span>`)
        strukSatuan.insertAdjacentHTML('beforeend', `<span>${formatRupiah(pesanan[4])}</span>`)
        strukTotal.insertAdjacentHTML('beforeend', `<span>${formatRupiah(pesanan[2])}</span>`)
    })
    
    const inputTunaiValue = document.getElementById('inputTunai').value
    const subTotalText = document.getElementById('subTotal').textContent
    
    document.getElementById('strukSubTotal').textContent = subTotalText
    document.getElementById('strukTunai').textContent = formatRupiah(inputTunaiValue)
    
    const subTotalValue = parseInt(subTotalText.replace('.', ''))
    const strukKembali = document.getElementById('strukKembali')
    if((inputTunaiValue - subTotalValue) == 0) {
        strukKembali.textContent = 'Lunas'
    } else {
        strukKembali.textContent = formatRupiah(inputTunaiValue - subTotalValue)
    }

}

function buatTransaksiBaru() {
    Swal.fire({
        title: 'Buat Transaksi Baru?',
        text: "Pastikan struk sudah dicetak ya!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if(result.isConfirmed) {
            location.reload()
        }
    })
}

function cetakStruk() {
    window.print()
}

function formatRupiah(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}