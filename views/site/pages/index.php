<?php

/* @var $this yii\web\View */

$this->title = 'eProfiling';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>eProfiling</h1>

        <p class="lead">Profail pengajar kemahiran berasaskan CUDBAS atas talian.</p>

        <p><a class="btn btn-lg btn-success" href="<?= Yii::$app->urlManager->createUrl(['personal/check'])?>">Daftar eProfiling</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Pengenalan</h2>

                <p>
                    Rancangan Malaysia Ke-11 (RMK11) telah meletakkan satu daripada enam teras iaitu
meningkatkan pembangunan modal insan untuk negara maju. Salah satu daripada usaha
untuk memenuhi teras ini adalah dengan membangunkan pangkalan data berpusat
mengenai profil jurang kompetensi dan menyediakan pelan hala tuju latihan yang
berkesan.
                </p>
               
                <p>
Untuk memenuhi matlamat ini satu projek Profiling Pengajar Kemahiran diperkenalkan. Projek ini bertujuan menutup jurang yang wujud pada setiap pengajar kemahiran supaya
latihan yang berkualiti dapat disampaikan kepada pelatih. Ia juga membangunkan
pengajar bidang kemahiran bertaraf dunia yang berpengetahuan, kompeten, berdisiplin
dan responsif terhadap perubahan persekitaran dan teknologi.
                </p>
                

                <!-- <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p> -->
            </div>
            <div class="col-lg-4">
                <h2>Profiling Pengajar Kemahiran</h2>

                 <p>
Profiling Pengajar Kemahiran adalah satu projek dimana pengumpulan keterampilan
pengajar kemahiran dikumpulan dan disatukan untuk dibandingkan dengan ability
checklist untuk mendapatkan jurang kompetensi pengajar. Ability checklist dihasilkan
dengan menggunakan kaedah CUDBAS (Curriculum Development Based on Vocational
Ability Structure).
                </p>

                <p>Profiling Pengajar Kemahiran adalah satu proses untuk mendapatkan data pengajar
kemahiran berkaitan:
                <ul>
                    <li>Kompetensi yang diperlukan oleh seseorang pengajar untuk menagajar sesuatu
program latihan kemahiran.</li>
                    <li>Maklumat kompetensi seseorang pengajar.</li>
                    <li>Jurang kompetensi pengajar untuk mengajar sesuatu program latihan kemahiran</li>
                </ul>
                </p>

                <!-- <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>-->
            </div>
            <div class="col-lg-4">
                <h2>eProfiling</h2>

                <p>
                    Sistem eProfiling adalah profiling pengajar kemahiran atas talian dibangunkan berdasarkan keperluan berikut:
                <ul>
                    <li>Dibangunkan sendiri dengan kepakaran dalaman CIAST. Perlu dilantik kakitangan
yang menjalankan tugas khusus sebagai tenaga pembangun.</li>
                    <li>Sesi perbincangan dan bengkel diantara pembangun sistem dan pakar CUDBAS
perlu dijalankan secara berkala bagi memastikan sistem dibangunkan dengan
spesifikasi yang diperlukan.</li>
                    <li>Sistem dibangunkan berkonsepkan web-enabled bagi memudahkan capaian di
seluruh negara.     </li>
                    <li>Modul yang dicadangkan dibina didalam sistem adalah
                        <ul>
                            <li>Modul Pentadbir Sistem</li>
                            <li>Modul Ability Checklist</li>
                            <li>Modul Laporan (bergantung kepada tahap keselamatan data dan capaian oleh pengguna)</li>
                        </ul>
                    </li>
                </p>

                <!-- <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p> -->
            </div>
        </div>

    </div>
</div>
