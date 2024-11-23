<template>
  <div id="app">
    <h1>My Places Page</h1>

    <div class="content">
      <div id="places">
        <div v-for="place in favoritePlaces" :key="place.id" class="place">
          <img :src="place.image" alt="Place image">
          <h3>{{ place.name }}</h3>
        </div>
      </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const places = ref([
  { id: 1, name: 'Last Exit Books', category: 'Shopping', image: 'https://kentwired.com/wp-content/uploads/2014/12/35e630f962572d58decea2b125db9f28.jpg' },
  { id: 2, name: 'Woodsy’s', category: 'Shopping', image: 'https://live.staticflickr.com/65535/50829941942_dac098946f_b.jpg' },
  { id: 3, name: 'Barrio', category: 'Food and Drink', image: 'https://cdn.usarestaurants.info/assets/uploads/07bd6a30c34c5d48b53d4d794d9e19ab_-united-states-ohio-portage-county-kent-barrio-kent-330-968-6118htm.jpg' },
  { id: 4, name: 'Squirrel City Jewelers', category: 'Shopping', image: 'https://www-s3-live.kent.edu/s3fs-root/s3fs-public/styles/teaser_image/public/article/SquirrelCity_header.jpg?VersionId=v7kg9I0B6nR40fi3lE.lkg08ZjLCSLxj&h=e6f36a9c&itok=TtCHu4wE' },
  { id: 5, name: 'Kent Free Library', category: 'Public Places', image: 'https://i.pinimg.com/736x/78/6a/92/786a92f1ebb0a5951d7e81f39d30c761--free-library-spring-break.jpg' },
  { id: 6, name: 'Scribbles Coffee Co', category: 'Food and Drink', image: 'https://s3-media0.fl.yelpcdn.com/bphoto/AlKg4dqHi1jhGzeAakK5rw/348s.jpg' },
  { id: 7, name: 'The Zephyr Pub', category: 'Food and Drink', image: 'https://kentwired.com/wp-content/uploads/2015/04/47cee280aa5c0db2297e3ac376e16e12.jpg' },
  { id: 8, name: 'Mike’s Place', category: 'Food and Drink', image: 'https://res.cloudinary.com/spothopper/image/fetch/f_auto,q_70,c_fit,h_864/http://static.spotapps.co/spots/58/5657a91a88460e8f207c9f369409a6/:original' },
  { id: 9, name: 'Chadwick Park', category: 'Outdoor Activities', image: 'https://www.kentohio.gov/media/moqkbq4o/img_0081-768x1024.jpg' },
  { id: 10, name: 'Kent State University Museum', category: 'Public Places', image: 'https://th.bing.com/th/id/OIP.-WkklQ6NRRQa1yqKkrg0mwHaFK?rs=1&pid=ImgDetMain' },
  { id: 11, name: 'Kent Historical Society & Museum', category: 'Public Places', image: 'https://th.bing.com/th/id/OIP.Hr3tlBu5C-j_r5B9PaoYPwHaFl?rs=1&pid=ImgDetMain' },
]);

const categories = ref(['Shopping', 'Public Places', 'Food and Drink', 'Outdoor Activities']);
</script>

<style scoped>
body {
  font-family: Arial, sans-serif;
  padding: 20px;
  background-color: #f4f4f9;
}

#app {
  display: flex;
  flex-direction: column;
  align-items: center;
}

h1 {
  font-size: 2rem;
  color: #333;
  margin-bottom: 20px;
}

.content {
  display: flex;
  justify-content: space-between;
  width: 100%;
  max-width: 1200px;
}

#places {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  width: 70%;
}

.place {
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 15px;
  text-align: center;
}

.place h3 {
  margin: 0;
  font-size: 1.2rem;
  color: #333;
}

.place p {
  color: #666;
  font-size: 0.9rem;
}

.place img {
  width: 100%;
  height: auto;
  border-radius: 5px;
}

</style>
