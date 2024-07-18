<!-- hero -->
<section class="hero" id="hero">
    <!-- hero body -->
    <div class="hero-body-member container col-xxl-8 px-4">
        <div class="pesanalert px-5">
            @if (session()->has('info_hari'))
                <div class="alert border-merah alert-dismissible fade show" role="alert">
                    <div class=""><span class="bi text-warning bi-exclamation-triangle"></span>
                        {{ session('info_hari') }}</div>
                    <button type="button" class="btn-close bg-danger" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="card shadow my-4">
            <div class="card-body">
                <canvas id="weeklyAttendanceChart"></canvas>
            </div>
        </div>
        <div class="text-white mb-1">
            <form action="/presensi" method="post">
                @csrf
                <div class="text-center mb-3">
                    <button class="btn border-merah" type="submit">Presensi</button>
                </div>
            </form>
        </div>
        {{-- <div class="card shadow">
            <div class="card-header text-center text-white" style="background-color: inherit">
                Member Ter Rutin bulan ini
            </div>
            <div class="bg-top-presensi">
                <div class="card-body text-center">
                    @foreach ($topPresensi as $top)
                        <div class="profil-img-topPresensi">
                            @if ($top->User->gambar)
                                <img src="{{ asset('storage/' . $top->User->gambar) }}" alt="" class="">
                            @else
                                <img src="/img/profile.png" alt="" class="">
                            @endif
                        </div>
                        <p class="text-dark" style="font-weight: 500">{{ $top->User->nama }}
                            ({{ $top->presence_count }})
                        </p>
                    @endforeach
                </div>
            </div>
        </div> --}}
    </div>
</section>

<!-- Personal Trainer -->
<section class="personaltrainer" id="personaltrainer">
    <div class="container">
        <!-- teks -->
        <div class="text-light">
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-5" style="font-weight: 400">PERSONAL TRAINER</h1>
                <p class="mb-3">Temukan potensi terbaikmu bersama personal trainer kami.</p>
                <a href="" class="btn border-merah text-light text-decoration-none bi bi-tag"
                    data-bs-toggle="modal" data-bs-target="#mymodal"> Pricelist PT</a>
            </div>
        </div>
        <!--  -->
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
    <div class="modal fade" id="mymodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content rounded-6 shadow">
                <div class="modal-body p-5">
                    <h5 class="fw-bold mb-3 text-center">Pricelist Personal Trainer</h5>
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
                    <button type="button" class="btn btn-secondary mt-2 w-100" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- tips --}}
<section id="tips" class="tips">
    <div class="container mb-5">
        <div class="pricing-header p-3 pb-md-4 mx-auto text-center text-white">
            <h1 class="display-5" style="font-weight: 400">TIPS FOR YOU</h1>
            <p class="mb-3">Kami memiliki beberapa tips yang mungkin anda butuhkan. Kami harap dapat membantu
                dalam
                mencapai potensi maksimal anda.</p>
        </div>
        <div class="tips-card shadow">
            <div class="row">
                <div class="tips-img-responsive col-4 col-xxl-3">
                    <img src="https://source.unsplash.com/random/?fitness" alt="" class="rounded img-fluid">
                </div>
                <div class="col-8 col-xxl-9 text-white">
                    <a href="#" class="border-0 text-decoration-none text-white" data-bs-toggle="modal"
                        data-bs-target="#tips1">
                        <h3>Tips Gym untuk Pemula</h3>
                        <p>Datang ke gym untuk pertama kali memang tidak mudah. Karena itu, mungkin kamu juga bisa
                            mempertimbangkan...</p>
                        <p class="card-text">
                            <div class="d-flex align-items-center">
                                <small style="color: #fa5246">Selengkapnya <small
                                        class="bi bi-arrow-right pt-2"></small></small>
                            </div>
                        </p>
                    </a>
                </div>
                <hr class="mt-3 text-white">
            </div>
        </div>
        <div class="tips-card  shadow my-3">
            <div class="row">
                <div class="tips-img-responsive col-4 col-xxl-3">
                    <img src="https://source.unsplash.com/random/?lifting,barbel,dumbel" alt=""
                        class="rounded img-fluid">
                </div>
                <div class="col-8 col-xxl-9 text-white">
                    <a href="#" class="border-0 text-decoration-none text-white" data-bs-toggle="modal"
                        data-bs-target="#tips2">
                        <h3>Tips Melatih Otot Upper Body</h3>
                        <p>Melatih otot upper body adalah bagian penting dari program kebugaran yang menyeluruh.
                            Berikut adalah serangkaian latihan...</p>
                        <p class="card-text">
                            <div class="d-flex align-items-center">
                                <small style="color: #fa5246">Selengkapnya <small
                                        class="bi bi-arrow-right pt-2"></small></small>
                            </div>
                        </p>
                    </a>
                </div>
                <hr class="mt-3 text-white">
            </div>
        </div>
        <div class="tips-card shadow my-3">
            <div class="row">
                <div class="tips-img-responsive col-4 col-xxl-3">
                    <img src="https://source.unsplash.com/random/?gym,legpress" alt=""
                        class="rounded img-fluid">
                </div>
                <div class="col-8 col-xxl-9 text-white">
                    <a href="#" class="border-0 text-decoration-none text-white" data-bs-toggle="modal"
                        data-bs-target="#tips3">
                        <h3>Tips Melatih Otot Lower Body</h3>
                        <p> Melatih otot lower body adalah bagian penting dari program kebugaran yang seimbang.
                            Melibatkan otot-otot seperti paha...</p>
                        <p class="card-text">
                            <div class="d-flex align-items-center">
                                <small style="color: #fa5246">Selengkapnya <small
                                        class="bi bi-arrow-right pt-2"></small></small>
                            </div>
                        </p>
                    </a>
                </div>
                <hr class="mt-3 text-white">
            </div>
        </div>
    </div>

    <!-- modal tips 1 -->
    <div class="modal fade" id="tips1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
            <div class="modal-content rounded-6 shadow">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">7 Tips Gym untuk Pemula</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="tips-img">
                        <img src="https://source.unsplash.com/random/?fitness" alt="" class="rounded">
                    </div>
                    <div class="body mt-3 mx-2" style="font-weight: 400">
                        <p>
                            Datang ke gym untuk pertama kali memang tidak mudah. Karena itu, mungkin kamu juga bisa
                            mempertimbangkan
                            untuk datang dengan teman atau langsung menyewa jasa personal trainer (PT). Agar lebih
                            percaya
                            diri,
                            kamu
                            bisa mempersiapkan diri dengan cara berikut ini.</p>

                        <p>1. Datang Dalam Keadaan Siap
                            Saat datang ke gym, pastikan bahwa kamu sudah menyiapkan diri untuk berlatih. Namanya
                            pemula,
                            mulailah
                            dengan latihan yang ringan.

                            Kamu tidak harus memakai setelan gym dari brand terkenal, pastikan saja untuk
                            menggunakan
                            pakaian yang
                            nyaman.

                            Jangan lupa untuk membawa air minum agar tidak dehidrasi selama latihan. Agar tetap
                            nyaman,
                            kamu
                            juga
                            bisa
                            membawa handuk kecil untuk membersihkan keringat atau mandi setelah berolahraga.</p>

                        <p>2. Fokus Pada Diri Sendiri
                            Saat baru pertama kali ke gym, kamu juga harus fokus pada gerakan latihan sendiri.
                            Cobalah
                            untuk
                            tidak
                            memperhatikan orang lain.

                            Terutama jika itu membuat kamu insecure. Anggap saja setiap orang di gym juga sibuk
                            dengan
                            latihannya
                            masing-masing.</p>

                        <p> 3. Lakukan Pemanasan
                            Walaupun hanya ingin ikut kelas latihan atau treadmill di gym, cobalah untuk tidak
                            melewatkan
                            pemanasan,
                            ya.

                            Tahap ini sangat penting untuk mengurangi risiko cedera. Gunakan 10 menit pertama untuk
                            menggerakan
                            otot-otot tubuhmu.

                            Terlepas dari gerakan pemanasan apa pun yang kamu pilih, sebaiknya kamu sudah sedikit
                            berkeringat
                            sebelum
                            beralih ke menu latihan utama.</p>

                        <p>4. Tidak Memaksakan Diri
                            Latihan apa pun yang kamu lakukan di pertemuan-pertemuan pertama, pastikan bahwa tubuhmu
                            masih
                            cukup
                            sanggup
                            melaluinya.

                            Kamu tidak perlu langsung melakukan latihan angkat beban jika memang belum terbiasa
                            melakukannya.

                            Otot-otot tubuhmu bisa sakit selama berhari-hari jika dipaksa bekerja terlalu keras.
                            Karena
                            itu,
                            buatlah
                            jadwal dan rencana latihan setiap hari agar tidak ototmu tidak terlalu sakit.</p>

                        <p>5. Mulai Secara Bertahap
                            Biasanya, latihan ke gym yang efektif bisa dimulai dengan datang sebanyak 2—3 kali
                            seminggu
                            dengan
                            durasi
                            30—45 menit.

                            Jika sudah dilakukan secara rutin selama 4—6 minggu, barulah kamu akan merasakan
                            perubahan
                            pada
                            diri
                            kamu.

                            Jika ingin memulai latihan ringan, kamu bisa mulai dengan datang ke kelas yoga, zumba,
                            cardio
                            dance,
                            atau
                            pound fit.

                            Durasi kelas rata-rata selama 60 menit, sudah termasuk pemanasan dan pendinginan selama
                            sesi
                            kelas. Jadi
                            lebih praktis, kan?</p>

                        <p> 6. Lakukan Pendinginan
                            Setelah selesai latihan, setidaknya lakukan gerakan pendinginan selama 5 menit. Kamu
                            hanya
                            perlu
                            melakukan
                            beberapa gerakan untuk melemaskan bagian yang kaku.

                            Tahap ini sangat penting untuk melonggarkan otot-otot setelah melakukan latihan yang
                            berat.
                        </p>

                        7. Ambil Waktu Istirahat (Rest Day)
                        Proses recovery adalah kunci agar rencana nge-gym kamu berhasil. Saat otot kamu terasa nyeri
                        selama
                        1—2 hari
                        setelah workout, berikan waktu agar tubuh beristirahat.</p>

                        <p>Tujuannya, rencana latihan kamu juga akan lebih mudah jika tubuh sudah dalam kondisi yang
                            lebih
                            baik.

                            Itulah beberapa tips gym pemula yang bisa kamu lakukan secara rutin. Walaupun sudah
                            mengambil
                            rest day,
                            jangan beristirahat terlalu lama dan luangkan waktu lagi untuk tetap kembali berlatih,
                            ya.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal tips 2 -->
    <div class="modal fade" id="tips2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
            <div class="modal-content rounded-6 shadow">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tips Melatih Otot Upper Body</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="tips-img">
                        <img src="https://source.unsplash.com/random/?lifting,barbel,dumbel" alt=""
                            class="rounded">
                    </div>
                    <div class="body mt-3 mx-2" style="font-weight: 400">
                        <p>
                            Melatih otot upper body adalah bagian penting dari program kebugaran yang menyeluruh.
                            Berikut adalah serangkaian latihan yang dapat membantu menguatkan dan membentuk
                            otot-otot
                            upper body, termasuk dada, bahu, punggung, dan lengan. Pastikan untuk memulai dengan
                            pemanasan sebelum melanjutkan ke latihan utama dan konsultasikan dengan profesional
                            kesehatan atau pelatih jika Anda memiliki masalah kesehatan atau cedera sebelum memulai
                            program latihan baru.
                        </p>

                        <p>1. Bench Press
                            <br>
                            Berbaring di bangku dengan punggung rata.
                            Pegang stang di atas kepala dengan lebar selebar bahu.
                            Tekan stang ke atas dengan melibatkan otot dada.
                            Turunkan kembali stang dengan kontrol.
                        </p>

                        <p>2. Dumbbell Shoulder Press
                            <br>
                            Duduk di bangku atau kursi dengan dumbbell di tangan.
                            Angkat kedua dumbbell ke atas di atas kepala dengan lengan lurus.
                            Turunkan kembali dengan kontrol.
                        </p>

                        <p> 3. Pull-Ups
                            <br>
                            Gantung dari bar dengan lengan lurus.
                            Tarik tubuh ke atas dengan membengkokkan siku.
                            Turunkan kembali tubuh dengan kontrol.
                            Untuk varian chin-up, pegang bar dengan tangan menghadap Anda.
                        </p>

                        <p>4. Bent Over Rows
                            <br>
                            Berdiri dengan kaki selebar bahu dan memegang dumbbell di tangan.
                            Condongkan tubuh ke depan dan dorong pinggul ke belakang.
                            Tarik dumbbell ke samping tubuh dengan siku melewati pinggang.
                        </p>

                        <p>5. Lat Pulldowns
                            <br>
                            Duduk di mesin lat pulldown dan pegang stang dengan tangan selebar bahu.
                            Tarik stang ke bawah ke arah dada dengan melibatkan otot punggung.
                        </p>

                        <p> 6. Tricep Dips
                            <br>
                            Gunakan parallel bars atau bangku tinggi.
                            Dorong tubuh ke atas dengan tangan, menjaga siku lurus.
                            Turunkan tubuh ke bawah hingga lengan membentuk sudut 90 derajat.
                        </p>
                        <p>
                            7. Bicep Curls
                            <br>
                            Pegang dumbbell di kedua tangan dengan lengan lurus di samping tubuh.
                            Angkat dumbbell ke arah bahu dengan membengkokkan siku.
                            Turunkan kembali dengan kontrol.
                        </p>

                        <p>8. Plank
                            <br>
                            Berbaring telentang dan angkat tubuh dari lantai dengan menggunakan siku dan jari kaki.
                            Pastikan tubuh membentuk garis lurus dari kepala hingga kaki.
                            Tahan posisi ini selama beberapa detik atau lebih.
                        </p>
                        <p>
                            9. Russian Twists
                            <br>
                            Duduk di lantai dengan lutut ditekuk dan kaki diangkat.
                            Pegang tangan bersama-sama di depan dada dan putar tubuh dari sisi ke sisi.
                        </p>
                        <p>
                            10. Push-Ups
                            <br>
                            Berbaring telentang dengan tangan sejajar dengan bahu.
                            Dorong tubuh ke atas dari lantai dengan lengan lurus.
                            Pastikan tubuh membentuk garis lurus dari kepala hingga kaki.

                        </p>
                        <p>
                            Lakukan latihan ini dengan teknik yang benar dan pilih beban yang sesuai dengan tingkat
                            kebugaran Anda. Juga, pastikan untuk memberikan istirahat yang cukup antara sesi latihan
                            dan
                            perhatikan pola makan yang seimbang untuk mendukung proses pemulihan dan pertumbuhan
                            otot.

                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal tips 3 -->
    <div class="modal fade" id="tips3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
            <div class="modal-content rounded-6 shadow">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tips Melatih Otot Lower Body</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="tips-img">
                        <img src="https://source.unsplash.com/random/?gym,legpress" alt="" class="rounded">
                    </div>
                    <div class="body mt-3 mx-2" style="font-weight: 400">
                        <p>
                            Melatih otot lower body adalah bagian penting dari program kebugaran yang seimbang.
                            Melibatkan otot-otot seperti paha, bokong, dan otot betis dapat meningkatkan kekuatan,
                            daya
                            tahan, serta membantu memelihara keseimbangan dan mobilitas. Berikut adalah beberapa
                            latihan
                            yang dapat membantu melatih otot lower body:
                        </p>

                        <p>1. Squat (Sikut)
                            <br>
                            Berdiri dengan kaki selebar bahu.
                            Tekuk lutut dan pinggul sehingga tubuh membentuk sudut 90 derajat.
                            Pastikan lutut tidak melewati ujung kaki.
                            Kembali ke posisi berdiri dengan mendorong tumit ke lantai.
                        </p>

                        <p>2. Deadlift
                            <br>
                            Berdiri dengan kaki selebar bahu dan pegang stang di depan tubuh dengan tangan selebar
                            bahu.
                            Tekuk pinggang dan lutut sedikit, dan turunkan stang ke bawah.
                            Kembali ke posisi berdiri dengan menjaga punggung lurus.
                        </p>

                        <p> 3. Lunges (Lunges)
                            <br>
                            Berdiri tegak dengan satu kaki maju.
                            Turunkan tubuh sehingga lutut membentuk sudut 90 derajat.
                            Kembali ke posisi berdiri dan ganti kaki.
                        </p>

                        <p>4. Leg Press
                            <br>
                            Duduk di mesin leg press dan tempatkan kaki di platform.
                            Dorong platform ke luar dengan melibatkan otot paha.
                            Kembali ke posisi awal dengan kontrol.
                        </p>

                        <p>5. Leg Curl
                            <br>
                            Berbaring telentang di mesin leg curl.
                            Angkat kaki ke arah bokong dengan melibatkan otot belakang paha.
                            Turunkan kembali dengan kontrol.
                        </p>

                        <p> 6. Calf Raises (Angkat Tumit)
                            <br>
                            Berdiri di tepi tangga atau platform dengan tumit menggantung.
                            Angkat tumit ke atas dengan melibatkan otot betis.
                            Turunkan kembali tumit di bawah platform.
                        </p>
                        <p>
                            7. Step-Ups (Step-Ups)
                            <br>
                            Gunakan bangku atau box yang cukup tinggi.
                            Angkat satu kaki ke atas dan letakkan kaki yang lain di atas platform.
                            Dorong tubuh ke atas dan turunkan kembali.
                        </p>

                        <p>8. Bulgarian Split Squat
                            <br>
                            Berdiri dengan satu kaki di belakang di atas bangku atau bench.
                            Tekuk lutut hingga membentuk sudut 90 derajat.
                            Angkat tubuh ke atas dengan melibatkan otot paha.
                        </p>
                        <p>
                            Tips Penting:
                            <br>
                            Pastikan untuk melakukan pemanasan sebelum melatih otot lower body untuk mengurangi
                            risiko
                            cedera.
                            Jaga postur tubuh dan fokus pada teknik yang benar saat melakukan latihan.
                            Mulailah dengan beban yang sesuai dengan kemampuan Anda dan tingkatkan secara bertahap.
                            Sertakan latihan ini dalam program latihan Anda dengan variasi untuk menjaga keberagaman
                            dan
                            memastikan semua kelompok otot terlibat.
                        </p>
                        <p>
                            Penting untuk berkonsultasi dengan profesional kesehatan atau pelatih kebugaran sebelum
                            memulai program latihan baru, terutama jika Anda memiliki kondisi kesehatan tertentu
                            atau
                            cedera.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</section>

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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var weeklyAttendanceData = @json($weeklyAttendance);

        var labels = weeklyAttendanceData.map(entry => 'Minggu ' + entry.week);
        var values = weeklyAttendanceData.map(entry => entry.attendance_count);

        var ctx = document.getElementById('weeklyAttendanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Presensi perminggu bulan ini',
                    backgroundColor: '#fa5246',
                    borderColor: '#fa5246',
                    borderWidth: 1,
                    data: values,
                }],
            },
            options: {
                scales: {
                    x: {
                        type: 'category',
                        offset: true,
                    },
                    y: {
                        beginAtZero: true,
                        precision: 0,
                        offset: true,
                    },
                },
            },
        });
    });
</script>
