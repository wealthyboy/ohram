<template>
  <div class="product-page-gallery">
        <div class="product-gallery-media mfp-gallery-popup">
            <div class="product-media-slider">
                <div class="product-gallery-image mfp-gallery-popup-link" :data-mfp-src="image">
                    <img :src="image" alt="Shop Online">
                </div>
                <div class="product-gallery-image mfp-gallery-popup-link" v-for="image in images" :key="image.id"  :data-mfp-src="image.image">
                    <img :src="image.image" alt="">
                </div>
                
            </div>
        </div>
        <div class="product-gallery-media-thumb">
            <div class="product-media-thumb-slider thumb-vertical-slider">
                <a class="product-gallery-image">
                    <img :src="image" alt="Shop Online">
                </a>
                 <a class="product-gallery-image" v-for="image in images" :key="image.id" >
                    <img :src="image.image"  :alt="image.image">
                </a>
                
            </div>
        </div>
    </div>
    
</template>

<script>
export default {
    props:{
        images: Array,
        image: String
    }
}
</script>