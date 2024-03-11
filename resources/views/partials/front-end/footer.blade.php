<!-- footer -->

<footer id="newsletter">
    <div class="container">
        <div class="row">
            <!-- Single Footer -->
            <div class="col-sm-4">
                <div class="single-footer">
                    <div class="footer-logo">
                        <h3 class="text-primary">Global Novalife</h3>
                        <p>
                            Construire un réseau où chaque membre s'auto-suffirait financièrement et habitationnellement est notre plus grande priorité !
                        </p>
                    </div>
                </div>
            </div>
            <!-- Single Footer -->
            
            <!-- Single Footer -->
            <div class="col-sm-4">
                <div class="single-footer">
                    <h3>Rester en contact</h3>
                    <p>Sénégal, Dakar <br />
                    BP : 29546 Dakar <br />
                    agbagbe1963@gmail.com <br />
                    </p>
                </div>
            </div>
            <!-- Single Footer -->
            
            <!-- Single Footer -->
            <div class="col-sm-4">
                <div class="single-footer">
                    <h3>Souscrire</h3>
                    <p>Entrez votre adresse e-mail pour vous abonner à nos newsletters mensuelles</p>
                    
                    @if (session()->has('success'))
                        <div class="alert text-white text-justify mt-3 alert-dismissible show" role="alert">
                        {{ session('success') }} 
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert text-danger text-justify alert-dismissible show" role="alert">
                        {{ session('error') }} 
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    <form method="POST" action="{{route('newsletter.submit')}}">
                        @csrf
                        <div class="form-group">
                            <input required type="email" name="newsletter_email" class="form-control my-form" id="newsletter_email" placeholder="Entrez votre adresse email">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-subscribe">Souscrire</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Single Footer -->
        </div>
    </div>
</footer>

<!-- Copyright -->
<div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="copy-text">
                        <p>
                            Tous droits réservés | Copyright 2019 &copy; 
                        </p>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-5">
                    <div class="social">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- footer -->
