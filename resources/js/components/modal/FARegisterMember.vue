<template>
  <div>
    <loading :active.sync="isLoading"
      :can-cancel="true"></loading>
      <form method="post" id="payment" name="ePayment" action="https://sandbox.ipay88.co.id/epayment/entry.asp">
      <input type="hidden" name="MerchantCode" v-bind:value="payment.merchant_code">
      <!-- <input type="hidden" name="PaymentId" value="52"> -->
      <input type="hidden" name="RefNo" v-bind:value="payment.ref_no">
      <input type="hidden" name="Amount" v-bind:value="`${payment.amount}`">
      <input type="hidden" name="Currency" value="IDR">
      <input type="hidden" name="ProdDesc" v-bind:value="payment.product_desc">
      <input type="hidden" name="UserName" v-bind:value="payment.user_name">
      <input type="hidden" name="UserEmail" v-bind:value="payment.user_email">
      <input type="hidden" name="UserContact" value="0126500100">
      <input type="hidden" name="Remark" value="">
      <input type="hidden" name="Lang" value="UTF-8">
      <input type="hidden" name="Signature" v-bind:value="payment.signature">
      <input type="hidden" name="ResponseURL" v-bind:value="payment.response_url">
      <input type="hidden" name="BackendURL" v-bind:value="payment.backend_url">
      </form>
    <form @submit.prevent="doRegister()">

      <div class="input-group col-md-12">
        <input autocomplete="off" class="form-control" type="text" v-model="form.referral" placeholder="Referal" required v-on:input="checkReferral">
          <p class="alert-referal" v-if="form.referral != ''">
            {{referral ? 'Referral ditemukan' : 'Referral tidak ditemukan'}}
          </p>
      </div>
      <br>
      <div class="input-group col-md-12">
          <input autocomplete="off" class="form-control" type="text" v-model="form.firstName"  minlength="2" placeholder="First Name" required>
      </div>
      <br>
      <div class="input-group col-md-12">
          <input autocomplete="off" class="form-control" type="text" placeholder="Last Name" v-model="form.lastName" >
      </div>
      <br>
      <div class="input-group col-md-12">
          <input class="form-control" type="text" v-on:input="checkUsername" id="username" placeholder="Username" v-model="form.username" required>
          <p class="alert-username" v-if="form.username != ''">
            {{username ? 'Username dapat digunakan' : 'Username tidak dapat digunakan'}}
          </p>
      </div>
      <br>
      <div class="input-group col-md-12">
          <input autocomplete="off" class="form-control" type="email" placeholder="Email" v-model="form.email" id="email" required>
      </div>
      <br>
      <div class="input-group col-md-12">
          <input autocomplete="off" class="form-control" type="text" placeholder="NIK/Passport" v-model="form.passport" id="passport" required>
      </div>
      <br>
      <div class="input-group col-md-12">
          <input autocomplete="off" type="date" v-model="form.birthdate"  class="form-control" placeholder="Birthdate" required>
      </div>
      <br/>
      <!-- <div class="input-group col-md-12">
        <h5 class="card-inside-title">Choose a pack</h5>
        <div class="form-group demo-radio-button">
          <input autocomplete="off" name="pack" type="radio" value="0" id="starterpack" class="with-gap radio-col-red" checked />
          <label for="shipping">Starter Pack</label>
        </div>
        <input type="text" id="choosepack">
      </div> -->
      <!-- {{form}} -->
      <div class="input-group col-md-12">
        <h5 class="card-inside-title">Choose a ebook</h5>
        <div class="form-group demo-radio-button">
          <span v-for="(ebook, index) in ebooks" :key="index" class="d-inline">
            <input v-on:click="selectedEbookPack(ebook)" name="ebook" type="checkbox" value="1" :id="`${ebook.title}`" class="with-gap radio-col-red"/>
            <label for="shipping">{{ ebook.title }}</label>
            &nbsp;&nbsp;&nbsp;&nbsp;
          </span>
          <!-- <input name="method" type="radio" value="1" id="starterpackebook" class="with-gap radio-col-red" />
          <label for="pickup">Starter Pack + Ebook</label> -->
        </div>
      </div>

      <div class="input-group col-md-12">
        <h5 class="card-inside-title">Choose a shipping method</h5>
        <div class="form-group demo-radio-button">
          <span v-for="(data, index) in shipping" :key="index">
            <input v-on:click="selectedShippingMethod(data.value)" name="method" type="radio" v-bind:valuealue="data.value" class="with-gap radio-col-red" />
            <label for="shipping">{{ data.title }}</label>&nbsp;&nbsp;&nbsp;&nbsp;
          </span>
        </div>
      </div>

      <div v-if="form.shipping == 1">
        <div class="input-group col-md-12" id="shipping-form">
          <div class="form-group">
             <multiselect v-model="form.province" :options="rajaongkir.province" :searchable="true" :close-on-select="true" @select="onChangeProvince" :show-labels="false" label="text" track-by="id" placeholder="Province"></multiselect>
          </div>
          <div class="form-group city-form">
             <multiselect v-model="form.city" :options="rajaongkir.city" :searchable="true" @select="onChangeCity" :close-on-select="true" :show-labels="false" label="text" track-by="id" placeholder="City"></multiselect>
          </div>
          <div class="form-group district-form">
            <multiselect v-model="form.subdistrict" @select="onChangeDistrict" :options="rajaongkir.subdistrict" :searchable="true" :close-on-select="true" :show-labels="false" label="text" track-by="id" placeholder="District"></multiselect>
          </div>
          <div class="form-group kurir-form">
            <multiselect v-model="form.kurir" @select="onChangeKurir" :options="rajaongkir.kurir" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Kurir" label="text" track-by="text"></multiselect>
          </div>
          <div class="form-group address-form">
            <textarea class="form-control" placeholder="Address" v-model="form.description"></textarea>
          </div>
          <!-- <div class="cost-form form-line" style="display:none">
            <input style="width:100%;" class="cost form-control" name="cost" id="cost" type="text">
          </div> -->
        </div>
      </div>
      <div v-else-if="form.shipping == 0">
        <span>B-G 168, Jl. Pluit Indah Raya, Pluit, Penjaringan, North Jakarta City, Jakarta 14450</span>
      </div>
      <div class="input-group col-md-12">
        <h5 class="card-inside-title">Choose a payment method</h5>
          <div class="form-group demo-radio-button">
          <span v-for="(data, index) in payments" v-on:click="selectedPaymentMethod(data.value)" :key="index">
            <input name="payment" type="radio" v-bind:valuealue="data.value" class="with-gap radio-col-red" :checked="data.value == form.payment"/>
            <label for="shipping">{{ data.title }}</label>&nbsp;&nbsp;&nbsp;&nbsp;
          </span>
        </div>
      </div>

      <div class="input-group col-md-12">
        <div v-if="form.shipping == 1">
          <h4>Total Price : {{parseInt(form.kurir != null ? form.kurir.id : 0) + totalPriceWithEbook + 280000}}</h4>
        </div>
        <div v-else-if="form.shipping == 0">
          <h4>Total Price Ebook : {{totalPriceWithEbook + 280000}}</h4>
        </div>
      </div>

      <div class="modal-footer">
        <div class="input-group col-md-12">
          <button :disabled="!username || !referral" type="submit" class="btn btn-join" style="border-radius: 5px; background-color: #b92240; color: #fff;">Submit</button>
        </div>
      </div>

    </form>
  </div>
</template>
<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import qs from 'qs'
import _ from 'lodash'
export default {
  components: {
    Loading
  },
  data () {
    return {
      form: {
        referral: '',
        firstName: '',
        lastName: '',
        email: '',
        username: '',
        passport: '',
        birthdate: '',
        ebooks: [],
        shipping: null,
        postalFee: 0,
        description: '',
        province: '',
        city: '',
        subdistrict: '',
        kurir: null,
        payment: null
      },
      ebooks: [
        {
          id: 1,
          title: 'Basic + Intermediate'
        },
        {
          id:  2,
          title: 'Advanced'
        }
      ],
      shipping: [
        {
          value: 1,
          title: 'Shipping'
        },
        {
          value: 0,
          title: 'Pickup'
        }
      ],
      payments: [
        {
          value: 'transfer',
          title: 'Transfer'
        },
        {
          value: 'ipay',
          title: 'Ipay88'
        }
      ],
      rajaongkir: {
        province: [],
        city: [],
        subdistrict: [],
        kurir: []
      },
      isLoading: false,
      payment: {
        merchant_key: '',
        merchant_code: '',
        currency: '',
        payment_id: '',
        product_desc: '',
        user_name: '',
        user_email: '',
        ref_no: '',
        lang: '',
        code: '',
        amount: '',
        signature: '',
        response_url: '',
        backend_url: ''
      },
      referral: false,
      username: false
    }
  },
  created () {
    
    this.getProvince()
    this.getEbooks()
  },
  computed: {
    totalPriceWithEbook() {
      return this.form.ebooks.length < 0
        ? 0
        : this.form.ebooks.reduce((acc, val) => {
          return parseInt(acc) + parseInt(val.price)
        }, 0)
    }
  },
  methods: {
    selectedEbookPack(ebook) {
      let check = this.form.ebooks.findIndex(data => data.id == ebook.id)
      if(check < 0) {
        this.form.ebooks.push(ebook)
      } else {
        this.form.ebooks.splice(check, 1)
      }
    },
    selectedShippingMethod(select) {
      this.form.shipping = parseInt(select)
    },
    selectedPaymentMethod(select) {
      this.form.payment = select
    },
    getEbooks() {
      this.isLoading = true
      axios.get('/api/ebook/ebooks')
        .then(res => {
          this.ebooks = res.data.data
          this.isLoading = false
        })
        .catch(err => {
          this.isLoading = false
        })
    },
    checkUsername: _.debounce(function(val){
      // axios.get(`${process.env.ROOT_API}/v1/product/units?q=${v}`, options).then(res => {
      //   this.datas = res.data.data
      // })
      this.isLoading = true
      axios.get('/user/' + val.target.value)
        .then(res => {
          this.username = res.data.username
          this.isLoading = false
        })
        .catch(err => {
          this.isLoading = false
        })
    }, 500),
    checkReferral: _.debounce(function(val){
      // axios.get(`${process.env.ROOT_API}/v1/product/units?q=${v}`, options).then(res => {
      //   this.datas = res.data.data
      // })
      this.isLoading = true
      axios.get('/user/' + val.target.value)
        .then(res => {
          this.referral = res.data.referal
          this.isLoading = false
        })
        .catch(err => {
          this.isLoading = false
        })
    }, 500),
    getProvince() {
      axios.get('/member/shipping/province')
        .then(res => {
          this.rajaongkir.province = res.data
        })
        .catch(err => {

        })
    },
    onChangeProvince(val = null) {
      this.rajaongkir.city = []
      this.rajaongkir.subdistrict = []
      this.rajaongkir.kurir = []
      if(typeof val == 'object') {
        this.isLoading = true
        this.getCity(val.id)
      }
    },
    getCity(val) {
      axios.get('/member/shipping/city/' + val)
        .then(res => {
          this.rajaongkir.city = res.data
          this.isLoading = false
        })
        .catch(err => {
          this.isLoading = false
        })
    },
    onChangeCity(val = null) {
      if(typeof val == 'object') {
        this.isLoading = true
        this.getSubdistrict(val.id)
      }
    },
    getSubdistrict(val) {
      axios.get('/member/shipping/subdistrict/' + val)
        .then(res => {
          this.rajaongkir.subdistrict = res.data
          this.isLoading = false
        })
        .catch(err => {
          this.isLoading = false
        })
    },
    onChangeDistrict(val = null) {
      this.isLoading = true
      this.getKurir(val.id)
    },
    getKurir(val) {
      console.log(val)
      axios.get('/member/shipping/cost/' + val)
        .then(res => {
          this.rajaongkir.kurir = res.data
          this.isLoading = false
        })
        .catch(err => {
          this.isLoading = false
        })
    },
    onChangeKurir(val) {
      this.form.postalFee = val.id
    },
    doRegister() {
      this.isLoading = true
      axios({
        url: '/register-member',
        method: 'POST',
        data: qs.stringify(this.form),
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      }).then(res => {
        console.log(res)
        console.log(res.data.data)
        this.payment = res.data.data.data
        if(this.form.payment == 'transfer') {
          alert('Register Successfully')
          //window.location.href = '/transaction/payment/BITREX009218'
        } else if(this.form.payment == 'ipay') {
          let form = document.getElementById('payment')
          alert('Register Successfully')
          this.isLoading = false
          // setTimeout(() => {
          //   form.submit()
          //   this.isLoading = false
          // }, 1000)
        }
        
      }).catch(err => {
        console.log(err)
        this.isLoading = false
      })
      // axios.post('/register-member?referral=aang&ebook=1&email=asepmedia18@gmail.com')
      //   .then(res => {
      //     this.payment = res.data.data.data
      //     let form = document.getElementById('payment')
      //     form.submit()
      //     this.isLoading = false
      //   })
      //   .catch(err => {
      //     this.isLoading = false
      //   })
    }
  }
}
</script>
