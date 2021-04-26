<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-sm-4 footer-contact">
                    <h3>PasPerDok</h3>
                    <p class="text-lead">
                        PasPerDok ( Pasien Perawat dan Dokter) adalah sebuah web, yang menampung 4 buah role,
                        yaitu pasien, perawat, dokter, dan admin. Dibuat dengan menggunakan framework Laravel 8.
                    </p>
                    <div class="mt-2">
                        <a href="https://github.com/PandjiAprillian" target="blank" ><i class="fab fa-github-square fa-2x mr-2"></i></a>
                        <a href="https://www.facebook.com/PandjiAprilian/" target="blank" ><i class="fab fa-facebook-square fa-2x mr-2"></i></a>
                        <a href="https://www.instagram.com/pandjiaprillian/" target="blank" ><i class="fab fa-instagram fa-2x mr-2"></i></a>
                        <a href="https://pandjiaprillian.github.io/" target="blank" ><i class="fas fa-globe-europe fa-2x"></i></a>
                    </div>
                </div>

                <div class="col-sm-3">
                    <h4>Alamat</h4>
                    <p>
                        Jl. Cemerlang No.8, Sukakarya<br>
                        Sukabumi, Jawa Barat<br>
                        Indonesia <br><br>
                    </p>
                </div>

                <div class="col-sm-2 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="{{ route('register') }}" class="text-primary"><strong>Register</strong></a></li>
                        <li><a href="#">Help/Contact Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                    </ul>
                </div>

                <div class="col-sm-3 footer-newsletter">
                    <h4>Hubungi Kami</h4>
                    <i class="fas fa-mobile mr-2"></i> +6289696961232<br>
                    <i class="fas fa-envelope mr-2"></i> pandjiaprilian@outlook.com<br>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex justify-content-center py-4">
        <div class="copyright text-center">
            &copy; Copyright <strong><span>PasPerDok</span></strong> {{ date('Y') }}
        </div>
    </div>
</footer>
