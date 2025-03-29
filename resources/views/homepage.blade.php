<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pricing
        Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <div class="pricing6 py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <h3 class="mb-3"></h3>
                        <h1 class="font-weight-normal">
                            TAHURA TRAIL RUNNING RACA 2025
                        </h1>
                    </div>
                </div>
                <!-- row  -->
                <div class="row mt-4">
                    <!-- column  -->
                    <div class="col-md-6">

                        <form action="checkout" method="POST">
                            @csrf

                            <input type="hidden" name="plan" value="basic">
                            <input type="hidden" name="price" value="125000">

                            <div class="card card-shadow border-0 mb-4">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <h5 class="font-weight-medium mb-0 mr-3">Basic Plan</h5>
                                        <div class="m-2">
                                            <span class="badge badge-danger font-weight-normal p-2">
                                                Popular
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5 text-center">
                                            <div class="price-box my-3">
                                                <sup>Rp.</sup><span class="text-dark display-5">125.000</span>
                                                <h6 class="font-weight-light">RUNNER 5K</h6>
                                                <button type="submit"
                                                    class="btn btn-info-gradiant font-14 border-0 text-white p-2 mt-1 btn-block">CHOOSE
                                                    PLAN</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 align-self-center">
                                            <ul class="list-inline pl-3 font-14 font-weight-medium text-dark">
                                                <li class="py-2">
                                                    <i class="icon-check text-info mr-2"></i>
                                                    <span>Nomer dada </span>
                                                </li>
                                                <li class="py-2">
                                                    <i class="icon-check text-info mr-2"></i>
                                                    <span>Makan siang</span>
                                                </li>
                                                <li class="py-2">
                                                    <i class="icon-check text-info mr-2"></i>
                                                    <span>Medali</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- column  -->
                    <!-- column  -->
                    <div class="col-md-6">

                        <form action="checkout" method="POST">
                            @csrf

                            <input type="hidden" name="plan" value="advance">
                            <input type="hidden" name="price" value="300000">

                            <div class="card card-shadow border-0 mb-4">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <h5 class="font-medium m-b-0">Advanced Plan</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5 text-center">
                                            <div class="price-box my-3">
                                                <sup>Rp.</sup><span class="text-dark display-5">300.000</span>
                                                <h6 class="font-weight-light">RUNNER 10K</h6>
                                                <button type="submit"
                                                    class="btn btn-info-gradiant font-14 border-0 text-white p-2 mt-3 btn-block">CHOOSE
                                                    PLAN</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 align-self-center">
                                            <ul class="list-inline pl-3 font-14 font-weight-medium text-dark">
                                                <li class="py-2">
                                                    <i class="icon-check text-info mr-2"></i>
                                                    <span>Nomer dada </span>
                                                </li>
                                                <li class="py-2">
                                                    <i class="icon-check text-info mr-2"></i>
                                                    <span>Makan siang</span>
                                                </li>
                                                <li class="py-2">
                                                    <i class="icon-check text-info mr-2"></i>
                                                    <span>Medali</span>
                                                </li>
                                                <li class="py-2">
                                                    <i class="icon-check text-info mr-2"></i>
                                                    <span>Meat and Great</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- column  -->
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

<style>
    @import url(//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800);

    .pricing6 {
        font-family: "Montserrat", sans-serif;
        color: #8d97ad;
        font-weight: 300;
    }

    .pricing6 h1,
    .pricing6 h2,
    .pricing6 h3,
    .pricing6 h4,
    .pricing6 h5,
    .pricing6 h6 {
        color: #3e4555;
    }

    .pricing6 .font-weight-medium {
        font-weight: 500;
    }

    .pricing6 .bg-light {
        background-color: #f4f8fa !important;
    }

    .pricing6 h5 {
        line-height: 22px;
        font-size: 18px;
    }

    .pricing6 .subtitle {
        color: #8d97ad;
        line-height: 24px;
    }

    .pricing6 .card.card-shadow {
        -webkit-box-shadow: 0px 0px 30px rgba(115, 128, 157, 0.1);
        box-shadow: 0px 0px 30px rgba(115, 128, 157, 0.1);
    }

    .pricing6 .price-box sup {
        top: -20px;
        font-size: 16px;
    }

    .pricing6 .price-box .display-5 {
        line-height: 58px;
        font-size: 3rem;
    }

    .pricing6 .btn-info-gradiant {
        background: #188ef4;
        background: -webkit-linear-gradient(legacy-direction(to right), #188ef4 0%, #316ce8 100%);
        background: -webkit-gradient(linear, left top, right top, from(#188ef4), to(#316ce8));
        background: -webkit-linear-gradient(left, #188ef4 0%, #316ce8 100%);
        background: -o-linear-gradient(left, #188ef4 0%, #316ce8 100%);
        background: linear-gradient(to right, #188ef4 0%, #316ce8 100%);
    }

    .pricing6 .btn-info-gradiant:hover {
        background: #316ce8;
        background: -webkit-linear-gradient(legacy-direction(to right), #316ce8 0%, #188ef4 100%);
        background: -webkit-gradient(linear, left top, right top, from(#316ce8), to(#188ef4));
        background: -webkit-linear-gradient(left, #316ce8 0%, #188ef4 100%);
        background: -o-linear-gradient(left, #316ce8 0%, #188ef4 100%);
        background: linear-gradient(to right, #316ce8 0%, #188ef4 100%);
    }

    .pricing6 .btn-md {
        padding: 15px 45px;
        font-size: 16px;
    }

    .pricing6 .text-info {
        color: #188ef4 !important;
    }

    .pricing6 .badge-danger {
        background-color: #ff4d7e;
    }

    .pricing6 .font-14 {
        font-size: 14px;
    }
</style>

</html>
