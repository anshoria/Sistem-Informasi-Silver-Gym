<!-- hero -->
<section class="hero" id="hero">
    <!-- hero body -->
    <div class="hero-body container col-xxl-8 px-4">
        <div class="hero-gap row flex-lg-row-reverse align-items-center g-5">
            <!-- img hero -->
            <div class="hero col-12 mx-auto col-lg-6">
                <img src="img/hero.png" class="d-block img-fluid" alt="Bootstrap Themes" width="700" height="500"
                    loading="lazy">
            </div>
            <!-- teks -->
            <div class="col-lg-6 text-white">
                <h1 class="welcome display-5 fw-bold lh-1 mb-3">Selamat datang di <span class="silver">Silver</span>
                    GYM</h1>
                <hr class="garis-merah">
                <p class="lead">Tingkatkan pengalaman kebugaranmu dengan menjadi member Silver Gym!
                    Dapatkan akses membership yang akan membantu progres latihanmu.</p>
                <div class="join d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="/Register" class="tombol btn btn-lg px-4 me-md-2">Join Now</a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Pricelist -->
<section class="pricelist" id="pricelist">
    <div class="container">
        <!-- teks -->
        <div class="text-light">
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h3 class="display-5" style="font-weight: 400">PRICELIST</h3>
                <p class="mb-3">Dapatkan pengalaman membership Silver Gym dengan beragam fasilitas unggulan
                    kami.</p>
                <a href="" class="btn border-merah text-light text-decoration-none bi bi-tag"
                    data-bs-toggle="modal" data-bs-target="#mymodal_2"> Pembayaran</a>
            </div>
        </div>
        <!-- card -->
        <div class="row my-3 text-center">
            @foreach ($Kategori as $kt)
                <div class="col col-12 col-sm-6 col-md-4">
                    <div class="card text-light mb-4 rounded-3 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 fw-normal">{{ $kt->nama }}</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">{{ $kt->harga }}</h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Berlaku selama <b>{{ $kt->masaaktif }}</b></li>
                                <li>{{ $kt->keterangan }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- modal pricelist -->
    <div class="modal fade" id="mymodal_2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content rounded-6 shadow">
                <div class="modal-body p-5">
                    <h4 class="fw-bold mb-2 text-center">Pembayaran</h4>
                    <p class="text-center">Hanya menerima pembayaran di tempat!</p>
                    <button type="button" class="btn btn-secondary mt-2 w-100" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- selingan gambar -->
<div class="selingan">
    <div class="content text-center">
        <h1 class="text-white mb-3">Tunggu apa lagi? Mulai sekarang!</h1>
        <a href="/Register" class="btn tombol">Join Now</a>
    </div>
</div>

<!-- Personal Trainer -->
<section class="personaltrainer" id="personaltrainer">
    <div class="container">
        <!-- teks -->
        <div class="text-light">
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-5" style="font-weight: 400">PERSONAL TRAINER</h1>
                <p class="mb-3">Temukan potensi terbaikmu bersama personal trainer kami.</p>
                <a href="" class="btn border-merah text-light text-decoration-none bi bi-tag"
                    data-bs-toggle="modal" data-bs-target="#mymodal1"> Pricelist PT</a>
            </div>
        </div>
        <!-- card -->
        <div class="row my-3 text-center">
            @foreach ($Trainers as $pt)
                <div class="cards col col-12 col-sm-6 col-lg-4 col-xxl-3">
                    <div class="pt card text-light mb-4 rounded-3">
                        <div class="card-header">
                            <h4 class="my-0 fw-normal">{{ $pt->nama }}</h4>
                        </div>
                        <img src="{{ asset('storage/' . $pt->foto) }}" alt="">
                        <div class="card-body">
                            <p>{{ $pt->kategori }}</p>
                            <a href="https://wa.me/{{ $pt->nohp }}" target="_blank"
                                class="btn border-merah text-light bi bi-whatsapp w-50"> Contact</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="mymodal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content rounded-6 shadow">
                <div class="modal-body p-5">
                    <h4 class="fw-bold mb-2 text-center">Pricelist Personal Trainer</h4>
                    <ul class="d-grid list-unstyled">
                        <b class="mb-0">SINGLE</b>
                        <table class="table-bordered mb-2">
                            <tbody class="text-center">
                                <tr>
                                    <td>900k</td>
                                    <td>10x Pertemuan</td>
                                </tr>
                                <tr>
                                    <td>120k</td>
                                    <td>1x Pertemuan</td>
                                </tr>
                            </tbody>
                        </table>
                        <b class="mb-0">COUPLE</b>
                        <table class="table-bordered">
                            <tbody class="text-center">
                                <tr>
                                    <td>1600k</td>
                                    <td>10x Pertemuan</td>
                                </tr>
                            </tbody>
                        </table>
                    </ul>
                    <button type="button" class="btn btn-secondary mt-2 w-100"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery -->
<section class="gallery" id="gallery">
    <h1 class="text-center display-5 mb-5" style="font-weight: 400">GALLERY</h1>
    <div class="gambar container">
        @foreach ($gambar as $gallery)
            <div class="box">
                <img src="{{ asset('storage/Gallery/' . $gallery->gambar) }}" alt="gallery">
            </div>
        @endforeach
    </div>
</section>

<!-- Kontak -->
<section class="kontak text-light" id="kontak">
    <h1 class="text-center display-5 mb-5" style="font-weight: 400">KONTAK KAMI</h1>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 col-xxl-6 fs-5">
                <h5>Alamat :</h5>
                <p>Brajan, Tamantirto, Kec. Kasihan, Kabupaten Bantul, DIY 55184, Kabupaten Bantul, Daerah
                    Istimewa Yogyakarta 55183</p>
                <h5>Whatsapp :</h5>
                <p>08157619911</p>
                <h5>Telepon :</h5>
                <p>08157619911</p>
            </div>
            <div class="col-12 col-lg 6 col-xxl-6">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d494.0858293230714!2d110.32899525092584!3d-7.
  822954368242826!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7af9e35bed8f61%3A0x5d11b49c9d0f8a03!2sSi
  lver%20Gym%20%26%20Aerobik!5e0!3m2!1sen!2sid!4v1702649532454!5m2!1sen!2sid"
                    class="map" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>
</main>

<footer>
    <div class="container text-light">
        <div class="sosmed mb-5 d-flex justify-content-start gap-2">
            <a href="https://www.instagram.com/silvergymjogja?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                target="_blank" class="btn tombol w-20"><i class="bi bi-instagram"></i> Instagram</a>
            <a href="https://wa.me/628157619911" target="_blank" class="btn btn-success w-20"><i
                    class="bi bi-whatsapp"></i>
                Whatsapp</a>
        </div>
        <div class="copyright">
            <p class="my-0">© 2023 Silver Gym Bantul. All Rights Reserved.</p>
            <p>Design by Muhammad Anshori Akbar</p>
        </div>
    </div>

</footer>
