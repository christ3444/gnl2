@extends('layouts.front-end')

@section('css')
  @mapstyles
@endsection

@section('main')
  <!-- Sider Start -->
  <div class="slider">
      <div id="fawesome-carousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators indicatior2">
              <li data-target="#fawesome-carousel" data-slide-to="0" class="active"></li>
              <li data-target="#fawesome-carousel" data-slide-to="1"></li>
              <li data-target="#fawesome-carousel" data-slide-to="2"></li>
          </ol>
          
          <div class="carousel-inner" role="listbox">
              <div class="item active">
                  <img src="{{asset('front_assets/img/slider1.jpg')}}" alt="Sider Big Image">
                  <div class="carousel-caption">
                      <h2 class="wow fadeInLeft">Nous promouvons l'immobilier grâce à un système hors paire !</h2>
                  </div>
              </div>
              <div class="item">
                  <img src="{{asset('front_assets/img/slider2.jpg')}}" alt="Sider Big Image">
                  <div class="carousel-caption">
                      <h2 class="wow fadeInLeft">Notre devise, une communauté financièrement épanouie !</h2>
                  </div>
              </div>

              <div class="item">
                  <img src="{{asset('front_assets/img/slider3.jpg')}}" alt="Sider Big Image">
                  <div class="carousel-caption">
                      <h2 class="wow fadeInLeft">Nous faisons de votre rêve immobilier une réalité !</h2>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Sider End -->
  
</header>
<!-- Header End -->

  <!-- About Section -->
  <section id="about" class="site-padding pb-1">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="about-image wow fadeInLeft">
            <img src="{{asset('front_assets/img/about-image.jpg')}}" alt="About Image" />
          </div>
        </div>
        <div class="col-sm-6">
          <div class="text-justify wow fadeInRight">
            <h3>Notre père fondateur</h3>
            <p>
              GBENAFA Aubert Mesmin dit Global Leader Aubert est de nationalité béninoise. C’est un Ingénieur de l'Aviation Civile Internationale né en 1963 à Dakoro (Niger) et qui a gravi les échelons dans le secteur aéronautique (pompier - contrôleur aérien – cadre supérieur…  ). Il est aussi titulaire d’un master en gestion des ressources humaines et dispose de solides connaissances en management financier et dans le domaine du MLM. Expert en marketing viral, coach MLM, Global Leader Aubert est également un émérite formateur, orateur et motivateur.<br>
              En tant que philanthrope, le Président Visionnaire Global Leader Aubert, a décidé mettre ses compétences au service du MLM pour faire autrement les choses en vue de redonner confiance et sourire aux personnes qui s’intéressent  au marketing relationnel. <br>
              Passionné par le Marketing relationnel ou le MLM depuis très longtemps, Le Global  Leader Aubert est aujourd'hui le Président Visionnaire de GLOBAL NOVALIFE. <br>
              Le paradigme proposé aux membres de la communauté internationale est une capacité financière optimale et un cadre de vie plus agréable, qui associe mieux vivre et respecter l'environnement.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- About Section -->
  
  <!-- Evolution in network Section -->
  <section id="evolution" class="site-padding py-2">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title">
            <h3>Evolution dans notre réseau</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          <div class="progress-bar-custom wow fadeInLeft">
            <h5>Niveau 0</h5>
            <div class="progress">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
              0%
              </div>
            </div>
          </div>
          
          <div class="progress-bar-custom wow fadeInLeft">
            <h5>Niveau 4</h5>
            <div class="progress">
              <div class="progress-bar" role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" style="width: 56%;">
              56%
              </div>
            </div>
          </div>
          
        </div>
        
        <div class="col-sm-3">
          <div class="progress-bar-custom wow fadeInLeft">
            <h5>Niveau 1</h5>
            <div class="progress">
              <div class="progress-bar" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100" style="width: 14%;">
              14%
              </div>
            </div>
          </div>
          
          <div class="progress-bar-custom wow fadeInLeft">
            <h5>Niveau 5</h5>
            <div class="progress">
              <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
              70%
              </div>
            </div>
          </div>
          
        </div>

        <div class="col-sm-3">
          <div class="progress-bar-custom wow fadeInLeft">
            <h5>Niveau 2</h5>
            <div class="progress">
              <div class="progress-bar" role="progressbar" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100" style="width: 28%;">
              28%
              </div>
            </div>
          </div>
          
          <div class="progress-bar-custom wow fadeInLeft">
            <h5>Niveau 6</h5>
            <div class="progress">
              <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">
              85%
              </div>
            </div>
          </div>
          
        </div>

        <div class="col-sm-3">
          <div class="progress-bar-custom wow fadeInLeft">
            <h5>Niveau 3</h5>
            <div class="progress">
              <div class="progress-bar" role="progressbar" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100" style="width: 42%;">
              42%
              </div>
            </div>
          </div>
          
          <div class="progress-bar-custom wow fadeInLeft">
            <h5>Niveau 7</h5>
            <div class="progress">
              <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
              100%
              </div>
            </div>
          </div>
          
        </div>

      </div>
    </div>
  </section>
  <!-- Evolution in network Section -->
  
  <!-- Motivation Section -->
  <section id="motivation" class="site-padding py-2">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title">
            <h3>Pourquoi <span>Global Novalife</span></h3>
          </div>
        </div>
      </div>
    </div>
    
    <div class="container">
      <div class="row">
      
        <!-- Single Motivation-->
        <div class="col-sm-4">
          <div class="single-feature wow fadeInLeft">
            <div class="row">
              <div class="col-md-2">
                <div class="feature-icon">
                  <i class="fa fa-empire"></i>
                </div>
              </div>
              <div class="col-md-10">
                <div class="feature-text">
                  <h4>Notre mission</h4>
                  <p class="text-justify">
                    La mission majeure de Global Novalife est de proposer durablement aux membres de la communauté une capacité financière optimale et un cadre de vie plus agréable qui associe mieux vivre ensemble, mixité sociale et respect de l’environnement.  
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Single Motivation-->
        
        <!-- Single Motivation-->
        <div class="col-sm-4">
          <div class="single-feature wow fadeInLeft">
            <div class="row">
              <div class="col-md-2">
                <div class="feature-icon">
                  <i class="fa fa-modx"></i>
                </div>
              </div>
              <div class="col-md-10">
                <div class="feature-text">
                  <h4>Notre Vision</h4>
                  <p class="text-justify">
                    Proposer des solutions adaptées et acceptées à l'immobilier sur le continent africain et ailleurs grâce aux financements participatifs (crowdfunding).  
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Single Motivation-->
        
        <!-- Single Motivation-->
        <div class="col-sm-4">
          <div class="single-feature wow fadeInRight">
            <div class="row">
              <div class="col-md-2">
                <div class="feature-icon">
                  <i class="fa fa-codiepie"></i>
                </div>
              </div>
              <div class="col-md-10">
                <div class="feature-text">
                  <h4>Notre philosophie</h4>
                  <p class="text-justify">
                    Une personne efficace et efficiente avant tout doit avoir un abri pour lui et sa famille. Global Novalife vous offre la double opportunité d'une capacité financière suffisante et d'une villa décente entièrement en votre nom sans assurance aux frais de la compagnie  de votre santé et votre bien-être.  
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Single Motivation-->
        
      </div>
    </div>
  </section>
  <!-- Motivation Section -->
  
  <!-- specificity Section -->
  <section id="specificity" class="site-padding py-2">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title">
            <h3>Notre spécificité</h3>
          </div>
        </div>
      </div>
    </div>
    
    <div class="container">
      <div class="row">
      
        <!-- Single specificity-->
        <div class="col-sm-6">
          <div class="single-feature wow fadeInLeft">
            <div class="row">
              <div class="col-md-2">
                <div class="feature-icon">
                  <i class="fa fa-users"></i>
                </div>
              </div>
              <div class="col-md-10">
                <div class="feature-text">
                  <h4>Comment devenir membre ?</h4>
                  <p class="text-justify">
                    <ul>
                      <li class="list-style-type-disc">Accepter les termes et conditions de la compagnie</li>
                      <li class="list-style-type-disc">Partager la même vision que tous les membres à savoir un pour tous et tous pour un dans la fraternité, l’amitié, le respect mutuel et dans la convivialité</li>
                      <li class="list-style-type-disc">Une inscription unique dont la valeur est de 5000F lorsque le principe de parrainage est accepté</li>
                      <li class="list-style-type-disc">Parrainer obligatoirement au moins deux personnes</li>
                      <li class="list-style-type-disc">Etre un bon leader, dynamique et actif et disponible</li>
                    </ul>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Single specificity-->
        
        <!-- Single specificity-->
        <div class="col-sm-6">
          <div class="single-feature wow fadeInLeft">
            <div class="row">
              <div class="col-md-2">
                <div class="feature-icon">
                  <i class="fa fa-tachometer"></i>
                </div>
              </div>
              <div class="col-md-10">
                <div class="feature-text">
                  <h4>Notre matrice</h4>
                  <p class="text-justify">
                    <ul>
                      <li class="list-style-type-disc">Très loin des matrices classiques et empiriques</li>
                      <li class="list-style-type-disc">Des paiements de bonus juste après deux parrainages</li>
                      <li class="list-style-type-disc">Matrice binaire, souple et flexible</li>
                      <li class="list-style-type-disc">Des paiements hebdomadaires</li>
                      <li class="list-style-type-disc">Une matrice moderne car conçue à partir de la dernière version de logiciel de codage</li>
                      <li class="list-style-type-disc">Une matrice très fiable</li>
                    </ul>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Single specificity-->
      </div>
    </div>
  </section>
  <!-- specificity Section -->
  
  <!-- Contact -->
  <section id="contact-us" class="py-2">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title">
            <h3>Contact <span>Us</span></h3>
          </div>
        </div>
      </div>
    </div>
  
    @map([
      'lat' => 14.7645042,
      'lng' => -17.3660286,
      'zoom' => 6,
      'markers' => [
        [
          'title' => 'Sénégal Dakar',
          'lat' => 14.7645042,
          'lng' => -17.3660286,
        ],
      ],
    ])  
    <div class="contact">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="my-2">Veuillez nous contacter pour tout type d'informations</h4>

            @if (session()->has('success'))
              <div class="alert text-success text-center mt-3 alert-dismissible show" role="alert">
                {{ session('success') }} 
                <button type="button" class="close" data-dismiss="alert">&times;</button>
              </div>
            @endif

            @if (session()->has('error'))
              <div class="alert text-danger text-center alert-dismissible show" role="alert">
                {{ session('error') }} 
                <button type="button" class="close" data-dismiss="alert">&times;</button>
              </div>
            @endif

            <form id="contact-form" action="{{route('contact.submit')}}" method="post">
              @csrf
              <div class="row">
                <div class="col-lg-4 field">
                  <input type="text" name="fullname" class="input" placeholder="* Nom complet" required min="4"/>
                </div>
                <div class="col-lg-4 field">
                  <input type="email" name="email" class="input" placeholder="* Adresse Email" required/>
                </div>
                <div class="col-lg-4 field">
                  <input type="text" name="subject" class="input" placeholder="Sujet" required />
                </div>
                <div class="col-lg-12 margintop10 field">
                  <textarea rows="10" name="message" class="input-block-level textarea" placeholder="* Message..." required></textarea>
                  <div>
                    <button id="submit" class="btn btn-theme margintop10 pull-left" type="submit">Soumettre le message</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>		
  <!-- Contact -->
@endsection

@section('js')
  <script>
  window.addEventListener('LaravelMaps:MapInitialized', function (event) {
    var element = event.detail.element;
    var map = event.detail.map;
    var markers = event.detail.markers;
    var service = event.detail.service;
  });
  </script>
  @mapscripts
  <script type="text/javascript">
    $(document).ready(function(){
      $('a[href^="#"]').on('click',function (e) {
        e.preventDefault();

        var target = this.hash;
        var $target = $(target);

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 900, 'swing');
      });

      $('#submit').click(function () {
        $('#contact-form').submit();
      })
    });
  </script>
@endsection
