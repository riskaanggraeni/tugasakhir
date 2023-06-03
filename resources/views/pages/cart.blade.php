@extends('layouts.app')

@section('title')
    Store Cart Page
@endsection

@section('content')
    <!-- Page Content -->
    <div class="page-content page-cart">
      <section
        class="store-breadcrumbs"
        data-aos="fade-down"
        data-aos-delay="100"
      >
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
                        @if($cart->product->galleries)
                          <img
                            src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                            alt=""
                            class="cart-image"
                          />
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
            <div class="col-12">
              <h2 class="mb-4">Shipping Details</h2>
            </div>
          </div>
          <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
            <div class="row mb-2" data-aos="fade-up" data-aos-delay="200" id="locations">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address_one">Address 1</label>
                  <input
                    type="text"
                    class="form-control"
                    id="address_one"
                    name="address_one"
                    value="Setra Duta Cemara"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address_two">Address 2</label>
                  <input
                    type="text"
                    class="form-control"
                    id="address_two"
                    name="address_two"
                    value="Blok B2 No. 34"
                  />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="mb-2">PROVINSI</label>
                    <select class="w-full border bg-white rounded px-3 py-2 outline-none" @change="getCitiesDestination" v-model="state.province_destination">
                      <option class="py-1" v-for="province in provinces" :key="province.id" :value="province.id">@{{ province.name }}</option>
                    </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="mb-2">KABUPATEN</label>
                  <select class="w-full border bg-white rounded px-3 py-2 outline-none" v-model="state.city_destination">
                   <option class="py-1" v-for="city in cities_destination" :key="city.id" :value="city.city_id">@{{ city.city_name }}</option>
                 </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="zip_code">Kode Pos</label>
                  <input
                    type="text"
                    class="form-control"
                    id="zip_code"
                    name="zip_code"
                    value="40512"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="country">Country</label>
                  <input
                    type="text"
                    class="form-control"
                    id="country"
                    name="country"
                    value="Indonesia"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="country">Berat</label>
                  <input type="text"  class="form-control" v-model="state.weight" placeholder="Masukkan Berat (Gram)">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone_number">Mobile</label>
                  <input
                    type="text"
                    class="form-control"
                    id="phone_number"
                    name="phone_number"
                    value="+628 2020 11111"
                  />
                </div>
                {{-- <div class="col-md-4">
                  <div class="form-group">
                    <label for="zip_code">berat</label>
                    <input
                      type="text"
                      class="form-control"
                      id="zip_code"
                      name="zip_code"
                      value="40512"
                    />
                  </div> --}}
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="mb-2">KURIR</label>
                      <select class="w-full border bg-white rounded px-3 py-2 outline-none" v-model="state.courier">
                        <option class="py-1" value="jne">JNE</option>
                        <option class="py-1" value="tiki">TIKI</option>
                        <option class="py-1" value="pos">POS</option>
                      </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="kurir_id">layanan</label>
                    <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id" v-if="regencies">
                      <option v-for="regency in regencies" :value="regency.id">@{{regency.name }}</option>
                    </select>
                    <select v-else class="form-control"></select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="150">
              <div class="col-12">
                <hr />
              </div>
              <div class="col-12">
                <h2 class="mb-1">Payment Informations</h2>
              </div>
            </div>
            {{-- <div class="row" data-aos="fade-up" data-aos-delay="200" id="paymentInfo"> --}}
              {{-- <div class="col-4 col-md-2">
                <div class="product-title">Rp0</div>
                <div class="product-subtitle">Country Tax</div>
              </div> --}}
              {{-- <div class="col-4 col-md-3">
                <div class="product-title">Rp0</div>
                <div class="product-subtitle">Product Insurance</div>
              </div> --}}
              {{-- <div class="col-4 col-md-2">
                <div class="product-title">
                  <ul>
                    <li v-for="result in payments" :key="result.code">
                      <h3>@{{ result.code }}</h3>
                      <ul>
                        <li v-for="cost in result.costs" :key="cost.value">
                          @{{ cost.description }} - @{{ cost.etd }}
                        </li>
                      </ul>
                    </li>
                  </ul>
                </div>
                <div class="product-subtitle">
                  >Ship to Sidoarjo
                </div>
              </div>
              <div class="col-4 col-md-2">
                <div class="product-title text-success">Rp{{ number_format($totalPrice ?? 0) }}</div>
                <div class="product-subtitle">Total</div>
              </div>
              <div class="col-8 col-md-3">
                <button
                  type="submit"
                  class="btn btn-primary mt-4 px-4 btn-block"
                >
                  Checkout Now
                </button>
              </div>
            </div> --}}
            <div class="grid sm:grid-cols-1 md:grid-cols-1 gap-4 p-4" v-if="resultCost">
              <div class="bg-white p-3 shadow-sm rounded">
                <h4 class="text-xl pb-1">HASIL ONGKOS KIRIM</h4>
                <hr class="border-2">
                <div class="mt-4" v-for="(value, index) in resultCost" :key="index">
                    @{{ value.service }} - @{{ value.cost[0].value }} - @{{ value.cost[0].etd }} Hari
                    <hr>
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
    <script  src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    {{-- <script>
      var locations = new Vue({
        el: "#locations",
        mounted() {
          this.getProvincesData();
        },
        data: {
          provinces: null,
          regencies: null,
          provinces_id: null,
          regencies_id: null,
        },
        methods: {
          getProvincesData() {
            var self = this;
            axios.get('{{ route('api-provinces') }}')
              .then(function (response) {
                  self.provinces = response.data;
              })
          },
          getRegenciesData() {
            var self = this;
            axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
              .then(function (response) {
                 console.log(self.provinces_id);
                  self.regencies = response.data;
              })
              
          },
        },
        watch: {
          provinces_id: function (val, oldVal) {
            this.regencies_id = null;
            this.getRegenciesData();
          },
        }
      });

      var paymentInfo = new Vue({
        el: "#paymentInfo",
        mounted() {
          this.getPaymentInfo();
        },
        data: {
          payments: null,
          provinces_id: null,
        },
        methods: {
          getPaymentInfo() {
            var self = this;
            axios.post('{{ route('kurir-cost') }}', {
              origin:'501',
              destination:'114',
              weight:1700,
              courier: "jne"
            })
              .then(function (response) {
                 resultCost.value = response.data.data[0].costs
                  console.log(resultCost.value);
              })
              .catch(error => {
                  console.error(error);
              })
          }
        },
        watch: {
          provinces_id: function (val, oldVal) {
            this.regencies_id = null;
            this.getRegenciesData();
          },
        }
      });
    </script> --}}
    <script type="module">

      // import { onMounted, reactive, ref } from 'vue'
      // import axios from 'axios'
      const { onMounted, reactive, ref } = Vue;
        export default {
      
          setup() {
      
            /**
             * state province
             */
            const provinces = ref({})
      
            /**
             * state ID for province and city
             */
            const state = reactive({
              
              province_origin: "",
              city_origin: "",
      
              province_destination: "",
              city_destination: "",
      
              weight: "",
              courier: ""
            })
      
            /**
             * state cities origin
             */
            const cities_origin    = ref({}) 
      
            /**
             * state cities destination
             */
            const cities_destination    = ref({}) 
      
            /**
             * resulCost
             */
            const resultCost = ref(null)
      
            onMounted(() => {
      
              axios.get('http://localhost:8000/api/provinces').then(response => {
                provinces.value = response.data.data
              })
              .catch(error => {
                console.log(error.response.data)
              })
      
            })
            
            /**
             * function getCitiesOrigin
             */
            function getCitiesOrigin() {
              
              axios.get(`http://localhost:8000/api/cities/${state.province_origin}`).then(response => {
                cities_origin.value = response.data.data
              })
              .catch(error => {
                console.log(error.response.data)
              })
      
            }
      
            /**
             * function getCitiesDestination
             */
            function getCitiesDestination() {
      
              axios.get(`http://localhost:8000/api/cities/${state.province_destination}`).then(response => {
                cities_destination.value = response.data.data
              })
              .catch(error => {
                console.log(error.response.data)
              })
      
            }
      
            /**
             * function getCostOngkir
             */
            function getCostOngkir() {
      
              axios.post('http://localhost:8000/api/checkOngkir/', {
      
                //send data ke server laravel
                origin: state.city_origin,
                destination: state.city_destination,
                weight: state.weight,
                courier: state.courier
      
              }).then(response => {
                resultCost.value = response.data.data[0].costs
              })
              .catch(error => {
                console.log(error.response.data)
              })
      
            }
      
            return {
              provinces, state, cities_origin, cities_destination, getCitiesOrigin, getCitiesDestination, getCostOngkir, resultCost
            }
      
          }
      
        }
      </script>
@endpush