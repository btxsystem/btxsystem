<template>
  <div>
    <div v-if="auth != null" class="row">
      <div class="col-8 mx-auto">
        <vue-countdown-timer
          v-if="ebook.access"
          :start-time="'2018-10-10 00:00:00'"
          :end-time="ebook.expired_timestamp"
          :interval="1000"
          :start-label="'Until start:'"
          :end-label="'Until end:'"
          label-position="begin"
          :end-text="'Event ended!'"
          :day-txt="'days'"
          :hour-txt="'hours'"
          :minutes-txt="'minutes'"
          :seconds-txt="'seconds'">
          <template slot="start-label" slot-scope="scope">
            <span></span>
          </template>
          <template slot="end-label" slot-scope="scope">
            <span></span>
          </template>
          <template slot="countdown" slot-scope="scope">
            <div :id="`clockdiv`" class="clockdiv mt-2">
              <div>
                <span class="days">{{scope.props.days}}</span>
                <div class="smalltext">Days</div>
              </div>
              <div>
                <span class="hours">{{scope.props.hours}}</span>
                <div class="smalltext">Hours</div>
              </div>
              <div>
                <span class="minutes">{{scope.props.minutes}}</span>
                <div class="smalltext">Minutes</div>
              </div>
              <div>
                <span class="seconds">{{scope.props.seconds}}</span>
                <div class="smalltext">Seconds</div>
              </div>
            </div>
          </template>          
        </vue-countdown-timer>
        <div v-else style="margin-top:120px"></div>
      </div>
    </div>
    <div class="shadow rounded p-3 border-hover bg-white triangle">
      <div class="row">
        <div class="col-lg-3 d-flex align-items-center">
          <img src="http://localhost:8000/assetsebook/v2/img/basic-and-intermediate.jpeg" class="mx-auto d-block img-fluid">
        </div>
        <div class="col-lg-9">
          <h2 class="plan-title mb-1 text-dark" style="color: #fb6e10;">
            <span>{{ ebook.title | textTitle}}</span>
          </h2>
          <span class="text-dark" v-html="ebook.description"></span>
          <br>
          <div>
            <!-- <form action="">
              <a href="http://ebook.bitrexgo.id:8000/explore/basic?username=" class="btn btn-identity-red btn-sm mt-3 px-5">BUY</a>
            </form> -->
            <div>
              <div v-if="ebook.access">
                <form action="" method="post">
                  <input type="hidden" name="ebook" v-model="ebook.id">
                  <input type="hidden" name="repeat" value="true">
                  <button type="submit" class="btn btn-identity-red text-white btn-sm mt-3 px-5">REPEAT ORDER</button>
                  <a v-if="!ebook.expired" href="#" class="btn btn-secondary text-white btn-sm mt-3 px-5">VIEW</a>
                </form>
              </div>
              <div v-else>
                <div v-if="ebook.status == 6">
                  <form action="" method="post">
                    <input type="hidden" name="ebook" v-model="ebook.id">
                    <button type="submit" class="btn btn-identity-red text-white btn-sm mt-3 px-5">BUY</button>
                  </form>
                </div>
                <div v-else>
                  <a href="#" class="btn btn-identity-red btn-sm mt-3 px-5">BUY</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div>
</template>
<script>
export default {
  props: {
    ebook: {
      default: () => null
    },
    auth: {
      default: null
    }
  },
  filters: {
    textTitle(char) {
      return char.charAt(0).toUpperCase() + char.substring(1);
    }
  },
}
</script>