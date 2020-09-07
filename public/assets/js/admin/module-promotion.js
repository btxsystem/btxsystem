/**
 * Promotion Ebook
 */

 class PromotionEbook {
   constructor(data = null) {
    this.id = data.id
    this.price = parseInt(data.price)
    this.priceDiscount = parseInt(data.priceDiscount)
    this.promotion = data.promotion
    this.minimumProduct = data.minimumProduct
    this.maximumProduct = data.maximumProduct
    this.totalHasProduct = data.totalHasProduct
    this.allowMergeDiscount = data.allowMergeDiscount
    this.registerPromotion = data.registerPromotion
    this.isPromotion = (this.totalHasProduct >= this.minimumProduct && this.totalHasProduct <= this.maximumProduct) && this.promotion
    this.totalPrice = 0
    this.totalDiscount = 0
   }

   /**
    * Jalankan pengecekan
    */
   run () {
    if(!this.isPromotion) {
      this.runWithoutPromotion()
      return this
    }

    this.runWithPromotion()

    return this
   }

   /**
    * Jalankan dengan promo
    */
   runWithPromotion() {
    this.totalPrice = (this.price - this.priceDiscount)
    this.totalDiscount = this.priceDiscount
   }

   /**
    * Jalankan tanpa promo
    */
   runWithoutPromotion() {
    this.totalPrice = this.price
    this.totalDiscount = 0
   }

   getOriginalPrice() {
    return this.price
   }

   getTotalPrice() {
    return this.totalPrice
   }

   getTotalDiscount() {
    return this.totalDiscount
   }
 }