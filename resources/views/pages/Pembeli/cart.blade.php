@extends('layouts.app')

@section('title')
    Store Cart Page
@endsection

@section('content')
    <!-- Page Content -->
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Cart
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart">
                            <thead>
                                <tr>
                                    <td>Image</td>
                                    <td>Name &amp; Seller</td>
                                    <td>Price</td>
                                    <td>Menu</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalPrice = 0 @endphp
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td style="width: 20%;">
                                            @if ($cart->product->galleries)
                                                <img src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                                                    alt="" class="cart-image" />
                                            @elseif ($cart->product->galleries == null)
                                                <h1>null</h1>
                                            @endif
                                        </td>
                                        <td style="width: 35%;">
                                            <div class="product-title">{{ $cart->product->name }}</div>
                                            <div class="product-subtitle">by {{ $cart->product->user->name }}</div>
                                        </td>
                                        <td style="width: 35%;">
                                            <div class="product-title">Rp{{ number_format($cart->product->price) }}</div>
                                            <div class="product-subtitle"></div>
                                        </td>
                                        <td style="width: 20%;">

                                            <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-remove-cart" type="submit">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php $totalPrice += $cart->product->price @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    {{-- <div class="col-12">
                        <h2 class="mb-4">Metode Pengiriman</h2>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="metode_pengiriman">Metode Pengiriman</label>
                                <select name="metodepengiriman" id="metode_pengiriman" class="form-control"
                                    v-model="pilihPengiriman">
                                    <option value="AMBILDIKAMPUS">AMBIL DI KAMPUS</option>
                                    <option value="KURIR">Kurir</option>
                                </select>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-12">
                        <h2 class="mb-4">Shipping Details</h2>
                    </div>
                </div>
                <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data" id="vueContent">
                    @csrf
                    <input type="hidden" name="total_price" id="total_price">
                    <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_one">Address 1</label>
                                <input type="text" class="form-control" id="address_one" name="address_one"
                                    value="Setra Duta Cemara" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_two">Address 2</label>
                                <input type="text" class="form-control" id="address_two" name="address_two"
                                    value="Blok B2 No. 34" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinces_id">Provinsi</label>
                                <select name="provinces_id" id="provinces_id" class="form-control" v-model="provinces_id"
                                    v-if="provinces">
                                    <option v-for="province in provinces" :value="province.province_id">
                                        @{{ province.province }}
                                    </option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="regencies_id">Kota</label>
                                <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id"
                                    v-if="regencies">
                                    <option v-for="regency in regencies" :value="regency.city_id">
                                        @{{ regency.city_name }}
                                    </option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zip_code">Kode Pos</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code" value="40512" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country"
                                    value="Indonesia" />
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Berat</label>
                                <input type="text" class="form-control" id="country" name="country"
                                    v-model="weight" />
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Mobile</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    value="+628 2020 11111" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <h2 class="mb-1">Payment Informations</h2>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kurir">Kurir</label>
                                    <select name="kurir" class="form-control"
                                        v-model="selectedCourier">
                                        {{-- @change="getServiceInfo"> --}}
                                        <option value="jne">JNE</option>
                                        <option value="pos">POS</option>
                                        <option value="tiki">TIKI</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" v-if="services">
                                <div class="form-group">
                                    <label for="kurir_id">Services</label>
                                    <select name="services" id="service_id" class="form-control" v-model="keyService">
                                        <option v-for="service in services" :value="service.service">
                                            @{{ service.description }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" data-aos="fade-up" data-aos-delay="200">
                            <div class="col-4 col-md-2" v-if="payments">
                                <div class="product-title text-success" v-for="result in payments">
                                    @{{ result[0].etd ?? 0 }} days</div>
                                <div class="product-subtitle">Ship to Sidoarjo</div>
                            </div>
                            <div class="col-4 col-md-2" v-if="payments">
                                <div class="product-title text-success">Rp
                                    @{{ total_ongkir }}
                                </div>
                                <input type="text" class="d-none" name="total_ongkir" id="total_ongkir">
                                <div class="product-subtitle">Total Ongkir</div>
                            </div>
                            <div class="col-4 col-md-2">
                                <div class="product-title text-success">Rp {{ number_format($totalPrice ?? 0) }}
                                </div>
                                <div class="product-subtitle">Total Harga</div>
                            </div>
                            <div class="col-4 col-md-2">
                                <div class="product-title text-success">Rp @{{ total_harga }}</div>
                                <div class="product-subtitle">Total</div>
                            </div>
                            <div class="col-8 col-md-3">
                                <button type="submit" class="btn btn-primary mt-4 px-4 btn-block">
                                    Checkout Now
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        var vueContent = new Vue({
            el: "#vueContent",
            mounted() {
                AOS.init();
                this.getProvincesData();
            },
            data: {
                provinces: null,
                regencies: null,
                provinces_id: null,
                regencies_id: null,
                payments: null,
                services: null,
                keyService: null,
                provinces_id: null,
                total_ongkir: null,
                total_harga: null,
                selectedCourier: "",
                weight: 0,
            },
            methods: {
                getProvincesData() {
                    var self = this;
                    axios.get('{{ route('kurir.provinces') }}')
                        .then(function(response) {
                            self.provinces = response.data.data;
                            console.log(self.provinces);
                        })
                },
                getRegenciesData() {
                    var self = this;
                    axios.get('{{ url('api/kurir/regencies') }}/' + self.provinces_id)
                        .then(function(response) {
                            console.log(self.provinces_id);
                            self.regencies = response.data.data;
                            console.log(self.regencies);
                        })

                },
                getPaymentInfo() {
                    var self = this;
                    //get cost form keyService

                    self.payments = self.services.filter(service => service.service == self.keyService).map(
                        service => service.cost);
                    self.total_ongkir = self.payments[0][0].value;
                    document.getElementById("total_ongkir").value = self.total_ongkir;
                    self.total_ongkir = self.total_ongkir.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    self.total_harga = self.payments[0][0].value + {{ $totalPrice ?? 0 }};
                    document.getElementById("total_price").value = self.total_harga;
                    self.total_harga = self.total_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    //change format to rupiah number
                    console.log(self.payments);
                },
                getServiceInfo() {
                    var self = this;
                    axios.post('{{ route('kurir.cost') }}', {
                            origin: '444',
                            destination: self.regencies_id,
                            weight: 1000,
                            courier: self.selectedCourier
                        })
                        .then(function(response) {
                            console.log("origin = 444");
                            console.log("destination = " + self.regencies_id);
                            console.log("weight = " + self.weight);
                            console.log(response.data.data);
                            self.services = response.data.data[0].costs;
                            console.log(self.services);
                        })
                        .catch(error => {
                            console.error(error);
                        })
                }
            },
            watch: {
                provinces_id: function(val, oldVal) {
                    this.regencies_id = null;
                    this.getRegenciesData();
                },
                selectedCourier: function(val, oldVal) {
                    this.keyService = null;
                    this.getServiceInfo();
                },
                keyService: function(val, oldVal) {
                    this.getPaymentInfo();
                }
            }
        });
    </script>
@endpush