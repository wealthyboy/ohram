<template>
    <div class="col-12 col-sm-6 col-lg-3 mb-2" v-for="n in count" :key="n">
      <div class="card h-100 shadow border-0 rounded-4 position-relative text-center">
        <div class="placeholder-glow p-4">
          <div class="placeholder w-100 mb-3" style="height: 200px;"></div>
          <div class="card-body d-flex flex-column">
            <div class="placeholder col-8 mb-2"></div>
            <div class="placeholder col-6 mb-3"></div>
            <div class="placeholder btn btn-secondary disabled col-6 mx-auto mb-2"></div>
            <div class="placeholder col-6 mx-auto"></div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ProductSkeleton',
    props: {
      count: {
        type: Number,
        default: 4
      }
    }
  }
  </script>
   