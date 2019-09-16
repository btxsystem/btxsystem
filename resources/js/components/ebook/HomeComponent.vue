<template>
  <div>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="max-height: 455px; overflow: hidden;">
      <div class="carousel-inner" style="background: #333;">
        <div class="carousel-item active">
          <img src="https://assets.regus.com/images/nwp/homepage-product-office-space.jpg" class="d-block w-100" style="opacity: 0.5">
        </div>
        <div class="carousel-item">
          <img src="https://img-prod-cms-rt-microsoft-com.akamaized.net/cms/api/am/imageFileData/RE2uXZM?ver=a904&q=90&m=2&h=768&w=1024&b=%23FFFFFFFF&aim=true" class="d-block w-100" style="opacity: 0.5">
        </div>
        <div class="carousel-item">
          <img src="https://www.it.unsw.edu.au/students/software/office365.jpeg" class="d-block w-100" style="opacity: 0.5">
        </div>
      </div>
    </div>
    <!--  -->
    <div style="position:relative;margin-top:-80px;">
      <div class="container">
        <div class="row">
          <div class="col-md-2 mx-auto">
            <div class="mt-3">
              <div v-if="propAuth != null">
                <a href="" class="btn btn-identity-red btn-block">Logout</a>
              </div>
              <div v-else>
                <button onclick="showModalLogin()" class="btn btn-identity-red btn-block text-white">Login</button>
              </div>
            </div>
          </div>
        </div>			
      </div>		
    </div>
    <!--  -->
    <div class="pt-5 pb-5" style="background-color:#ffb320;">
      <div class="container pt-5">
        <div class="row">
          <!--  -->
          <div v-for="(ebook, index) in getEbooks" :key="index" class="col-lg-6 mb-3">
            <ebook-card
              :ebook="ebook"
              :auth="propAuth"/>
          </div>
          <!--  -->
        </div>
      </div>
    </div>    
    <!--  -->
  </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import EbookCard from './partials/EbookCard'
export default {
  components: {
    EbookCard
  },
  props: {
    propAuth: {
      default: null
    },
    endpointEbooks: {
      default: null
    }
  },
  created() {
    console.log(this.endpointEbooks)
    this.FETCH_EBOOK(this.endpointEbooks)
  },
  computed: {
    ...mapGetters([
      'getEbooks'
    ])
  },
  methods: {
    ...mapActions([
      'FETCH_EBOOK'
    ])
  }
}
</script>