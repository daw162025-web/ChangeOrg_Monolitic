@extends('layouts.public')

@section('content')

    <div class="panel1 mb-5">
        <!-- Modo responsive -->
        <div class="d-lg-none bg-transparent">
            <div class="u-center-content bg-transparent">
                <h1 class="tituloPrincipal">El cambio <br> comienza aquí.</h1>
                <h3>Únete a <strong>567.044.940</strong> personas que <br> están impulsando un cambio real<br>en sus comunidades.</h3>
                <a href="{{ route('petitions.edit-add') }}" class="btn btn-primary col-12 mb-3 mt-3">Crear una petición</a>
                <a class="btn btn-petition col-12 mb-3 me-2">Comenzar con IA</a>
            </div>
            <div id="carouselEx" class="carousel slide carousel-dark bg-transparent">
                <div class="carousel-inner px-5 bg-transparent">
                    <div class="carousel-item active card text-center bg-transparent">
                        <img src="{{asset('assets/imagenes/carousel1.jpg')}}"
                             class="card-img-top rounded-circle mx-auto mt-3"
                             style="width: 200px; height: 200px; object-fit: cover;"
                        >
                        <div class="card-body px-4 text-center bg-transparent">
                            <h5 class="card-title">🔴 ¡Victoria!</h5>
                            <h6> 157.929 firmas</h6>

                        </div>
                    </div>
                    <div class="carousel-item card text-center bg-transparent">
                        <img src="{{asset('assets/imagenes/carousel2.jpg')}}"
                             class="card-img-top rounded-circle mx-auto mt-3"
                             style="width: 200px; height: 200px; object-fit: cover;"
                        >
                        <div class="card-body px-4 text-center bg-transparent">
                            <h5 class="card-title">🔴 ¡Victoria!</h5>
                            <h6> 96.241 firmas</h6>
                        </div>
                    </div>
                    <div class="carousel-item  card text-center bg-transparent">
                        <img src="{{asset('assets/imagenes/carousel3.jpg')}}"
                             class="card-img-top rounded-circle mx-auto mt-3"
                             style="width: 200px; height: 200px; object-fit: cover;"
                        >
                        <div class="card-body px-4 text-center bg-transparent">
                            <h5 class="card-title">🔴 ¡Victoria!</h5>
                            <h6> 141.337 firmas</h6>
                        </div>
                    </div>
                    <div class="carousel-item  card text-center bg-transparent">
                        <img src="{{asset('assets/imagenes/carousel4.jpg')}}"
                             class="card-img-top rounded-circle mx-auto mt-3"
                             style="width: 200px; height: 200px; object-fit: cover;"
                        >
                        <div class="card-body px-4 text-center bg-transparent">
                            <h5 class="card-title">🔴 ¡Victoria!</h5>
                            <h6> 192.190 firmas</h6>
                        </div>
                    </div>
                    <div class="carousel-item  card text-center bg-transparent">
                        <img src="{{asset('assets/imagenes/carousel5.jpg')}}"
                             class="card-img-top rounded-circle mx-auto mt-3"
                             style="width: 200px; height: 200px; object-fit: cover;"
                        >
                        <div class="card-body px-4 text-center bg-transparent">
                            <h5 class="card-title">🔴 ¡Victoria!</h5>
                            <h6> 162.856 firmas</h6>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev bg-transparent" type="button" data-bs-target="#carouselEx" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next bg-transparent" type="button" data-bs-target="#carouselEx" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <!-- Modo completo -->
        <!-- lo oculta cuando es resposive y cuando es large lo muestra como bloque (ocupa todo el ancho disp) -->
        <div class="d-none d-lg-block u-shape-wrapper bg-transparent mx-5">

            <div class="row justify-content-center">

                <div class="col-lg-3 ">
                    <div class="p-6 d-flex justify-content-center">
                        <div class="card cardU">
                            <img src="{{asset('assets/imagenes/carousel1.jpg')}}"
                                 class="card-img-top rounded-circle mx-auto mt-3"
                                 style="width: 200px; height: 200px; object-fit: cover;"
                            >
                            <div class="card-body card-bodyU mx-3 text-center">
                                <h5 class="card-title">🔴 ¡Victoria!</h5>
                                <h6> 96.241 firmas</h6>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 d-flex justify-content-center">
                        <div class="card cardU" style="margin-left: 90px;">
                            <img src="{{asset('assets/imagenes/carousel2.jpg')}}"
                                 class="card-img-top rounded-circle mx-auto mt-3"
                                 style="width: 200px; height: 200px; object-fit: cover;"
                            >
                            <div class="card-body card-bodyU mx-3 text-center">
                                <h5 class="card-title">🔴 ¡Victoria!</h5>
                                <h6> 96.241 firmas</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="u-center-content bg-transparent g-2">
                        <h1 class="tituloPrincipal2 mx-auto">El cambio <br> comienza aquí.</h1>
                        <h3 class="parrafoL mx-auto mb-3">Únete a <span style="font-weight:bold">567.052.997</span> personas que están impulsando un cambio real en sus comunidades.</h3>
                        <a href="{{ route('petitions.edit-add') }}" class="btn btn-primary">Crear una petición</a>
                        <a class="btn btn-petition">Comenzar con IA</a>
                    </div>

                    <div class="row">
                        <div class="p-6 d-flex justify-content-center">
                            <div class="card cardU">
                                <img src="{{asset('assets/imagenes/carousel3.jpg')}}"
                                     class="card-img-top rounded-circle mx-auto mt-3"
                                     style="width: 200px; height: 200px; object-fit: cover;"
                                >
                                <div class="card-body card-bodyU mx-3 text-center">
                                    <h5 class="card-title">🔴 ¡Victoria!</h5>
                                    <h6> 141.337 firmas</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 ">
                    <div class="p-6 d-flex justify-content-center">
                        <div class="card cardU" >
                            <img src="{{asset('assets/imagenes/carousel4.jpg')}}"
                                 class="card-img-top rounded-circle mx-auto mt-3"
                                 style="width: 200px; height: 200px; object-fit: cover;"
                            >
                            <div class="card-body card-bodyU mx-3 text-center">
                                <h5 class="card-title">🔴 ¡Victoria!</h5>
                                <h6> 192.190 firmas</h6>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 d-flex justify-content-center">
                        <div class="card cardU" style="margin-right: 90px;">
                            <img src="{{asset('assets/imagenes/carousel5.jpg')}}"
                                 class="card-img-top rounded-circle mx-auto mt-3"
                                 style="width: 200px; height: 200px; object-fit: cover;"
                            >
                            <div class="card-body card-bodyU mx-3 text-center">
                                <h5 class="card-title">🔴 ¡Victoria!</h5>
                                <h6> 162.856 firmas</h6>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <!-- Categorias con peticiones -->
    <div class="container mt-5 mb-5 mb-lg-3">
        <h2 class="mt-4" style="font-weight: 700;">Apoya causas que te importan</h2>
        <h6 class="mt-4">Encuentra peticiones que te conmuevan y alza tu voz para lograr el cambio.</h6>
        <div class="d-flex flex-wrap g-3 mt-4">
            <button class="btn btn-categorias me-3 mt-3">Sanidad 🡢 </button>
            <button class="btn btn-categorias mx-3 mt-3">Animales 🡢 </button>
            <button class="btn btn-categorias mx-3 mt-3">Medio Ambiente 🡢 </button>
            <button class="btn btn-categorias mx-3 mt-3">Educacion 🡢 </button>
            <button class="btn btn-categorias mx-3 mt-3">Justicia Economica 🡢 </button>
        </div>
    </div>
    <div class="container mt-3 pb-5">
        <div class="row g-4">

            <div class="col-md-6 col-lg-3">
                    <div class="card feature-card h-100" >
                        <div class=" p-3">
                            <img src="{{asset('assets/imagenes/peticion1.jpg')}}" class="img- fluid card-img-top imagen-reducida">
                            <div class="card-body">
                                <h5 class="card-title">Mi hija se suicidó con 15 años. El bullying NO es cosa de niñ@s> ¡LEY DE ACOSO ESCOLAR YA!</h5>
                                <p class="card-text">260.030 firmas</p>

                            </div>
                        </div>
                    </div>

                </div>
            <div class="col-md-6 col-lg-3">
               <div class="card feature-card h-100">
                        <div class=" p-3">
                            <img src="{{asset('assets/imagenes/peticion2.jpg')}}" class="img- fluid card-img-top imagen-reducida">
                            <div class="card-body">
                                <h5 class="card-title">El asesino de mi hijo tenía 17 años. Pido revisar YA la ley del menor para casos graves</h5>
                                <p class="card-text ">58.079 firmas</p>

                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="https://www.change.org/p/me-han-echado-de-clase-por-llevar-hiyab-libertad-religiosa-ya-en-instituto-ies-sagasta" class="text-decoration-none text-dark" >
                    <div class="card feature-card h-100">
                        <div class=" p-3">
                            <img src="{{asset('assets/imagenes/peticion3.jpg')}}" class="img- fluid card-img-top imagen-reducida" >
                            <div class="card-body">
                                <h5 class="card-title">Me han echado de clase por llevar Hiyab. ¡Libertad religiosa YA en instituo IES Sagasta!</h5>
                                <p class="card-text">11.433 firmas</p>

                            </div>
                        </div>
                    </div></a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{route('petitions.show', 1)}}" class="text-decoration-none text-dark">
                    <div class="card feature-card h-100">
                        <div class="p-3">
                            <img src="{{asset('assets/imagenes/peticion4.jpg')}}" class="img- fluid card-img-top imagen-reducida" >
                            <div class="card-body">
                                <h5 class="card-title">Soy víctima de violencia machista. Pido mejorar urgentemente las pulseras de protección</h5>
                                <p class="card-text">31.747 firmas</p>

                            </div>
                        </div>
                    </div></a>
            </div>
        </div>
    </div>

    <!-- Ultimo div -->
    <div class="container my-4 ">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2">
                <div class="card" style="top: 20px; border: none;">
                    <div class="card-body">
                        <img src="{{asset('assets/imagenes/personas.jpg')}}" class="img-fluid card-img-top " >
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card" style="top: 20px; border: none;">
                    <div class="card-body">
                        <h2 class="mt-4" style="font-weight: 700;">Apoya el cambio Contribuye hoy</h2>
                        <h6 class="mt-4">Change.org es una organización independiente, financiada únicamente por millones de usuarios como tú. Colabora con Change para proteger el poder de las personas que marcan una diferencia.</h6>
                        <button class="btn btn-petition me-3 mt-3">Contribuir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
