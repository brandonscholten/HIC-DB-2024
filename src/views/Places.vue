<template>
  <div id="app">
    <div class="content">
      <div id="filters">
        <!-- <h2>Filter by Category</h2> -->
        <div class="checkbox-group" v-for="(category, index) in categories" :key="index">
          <input type="checkbox" :id="category" v-model="selectedCategories" :value="category">
          <label :for="category">{{ category }}</label>
        </div>
      </div>

      <div id="places"> 
        <div v-for="place in filteredPlaces" class="place">
          <PlaceCard
            :title = place.name
            description = "TODO add a description"
            :rating="1"
            mapsLink="https://maps.google.com"
            :imagePath="place.image"
            extendedDescription="TODO add an extended description?"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import PlaceCard from '/src/components/PlaceCard.vue';

// const places = ref([
//   { id: 1, name: 'Last Exit Books', category: 'Shopping', image: 'https://kentwired.com/wp-content/uploads/2014/12/35e630f962572d58decea2b125db9f28.jpg' },
//   { id: 2, name: 'Woodsy\’s', category: 'Shopping', image: 'https://live.staticflickr.com/65535/50829941942_dac098946f_b.jpg' },
//   { id: 3, name: 'Barrio', category: 'Food and Drink', image: 'https://cdn.usarestaurants.info/assets/uploads/07bd6a30c34c5d48b53d4d794d9e19ab_-united-states-ohio-portage-county-kent-barrio-kent-330-968-6118htm.jpg' },
//   { id: 4, name: 'Squirrel City Jewelers', category: 'Shopping', image: 'https://www-s3-live.kent.edu/s3fs-root/s3fs-public/styles/teaser_image/public/article/SquirrelCity_header.jpg?VersionId=v7kg9I0B6nR40fi3lE.lkg08ZjLCSLxj&h=e6f36a9c&itok=TtCHu4wE' },
//   { id: 5, name: 'Kent Free Library', category: 'Public Places', image: 'https://i.pinimg.com/736x/78/6a/92/786a92f1ebb0a5951d7e81f39d30c761--free-library-spring-break.jpg' },
//   { id: 6, name: 'Scribbles Coffee Co', category: 'Food and Drink', image: 'https://s3-media0.fl.yelpcdn.com/bphoto/AlKg4dqHi1jhGzeAakK5rw/348s.jpg' },
//   { id: 7, name: 'The Zephyr Pub', category: 'Food and Drink', image: 'https://kentwired.com/wp-content/uploads/2015/04/47cee280aa5c0db2297e3ac376e16e12.jpg' },
//   { id: 8, name: 'Mike\’s Place', category: 'Food and Drink', image: 'https://res.cloudinary.com/spothopper/image/fetch/f_auto,q_70,c_fit,h_864/http://static.spotapps.co/spots/58/5657a91a88460e8f207c9f369409a6/:original' },
//   { id: 9, name: 'Chadwick Park', category: 'Outdoor Activities', image: 'https://www.kentohio.gov/media/moqkbq4o/img_0081-768x1024.jpg' },
//   { id: 10, name: 'Kent State University Museum', category: 'Public Places', image: 'https://th.bing.com/th/id/OIP.-WkklQ6NRRQa1yqKkrg0mwHaFK?rs=1&pid=ImgDetMain' },
//   { id: 11, name: 'Kent Historical Society & Museum', category: 'Public Places', image: 'https://th.bing.com/th/id/OIP.Hr3tlBu5C-j_r5B9PaoYPwHaFl?rs=1&pid=ImgDetMain' },
// ]);

const places = ref([]);

const categories = ref(['Shopping', 'Public Places', 'Food and Drink', 'Outdoor Activities']);
const selectedCategories = ref([]);

//TODO: write an API call to get a list of places
const baseURL = "https://localhost:5941/"
if (getCookie('session_id')) {
  //TODO only retrieve places that pertain to the user
  try {
    const response = await fetch(url+"get_user_places");
  } catch {
    console.error(error.message);
  }
} else {
  //get all places from the database
  try {
    const response = await fetch(url+"get_places");
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const json = await response.json();
    console.log("received response:");
    console.log(json);
  } catch {
    console.error(error.message);
  }
}

const filteredPlaces = computed(() => {
  if (selectedCategories.value.length === 0) {
    return places.value;
  }
  return places.value.filter(place =>
    selectedCategories.value.includes(place.category)
  );
});
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
}

.content {
  padding-top: 50px;
  padding-bottom: 50px;
  display: flex;
  justify-content: space-around;
  width: 100%;
  max-width: 1500px;
}

#filters {
  margin-right: 45px;
  margin-left: 20px;
  margin-top: 50px;
  background-color: rgba(255, 255, 255, 0.54);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  justify-content: center;
  justify-content: space-around;
  padding: 20px;
  height: fit-content;
  width: 300px;
  padding-left: 20px;
}

#places {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  margin-left: 10px;
  gap: 20px;
  width: 100%;
}

.place {
  flex: 1 1 calc(50% - 20px);
  max-width: calc(50% - 20px);
  box-sizing: border-box;
}

.checkbox-group {
  margin-bottom: 5px;
  display: flex;
  flex-direction: row;
  align-items: center;
}

@media screen and (max-width: 1222px) {
  .content{
    flex-direction: column;
    overflow: hidden;
  }
  #filters{
    background-color: rgba(255, 255, 255, 0.54);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    height: 100%;
    margin: auto;
    display: flex;
    flex-direction: row;
    justify-content: left;
  }
  .checkbox-group {
    margin-bottom: 0px;
    padding: 10px;
  }
}

@media screen and (max-width: 920px) {
  #places {
    flex-direction: column;
    align-items: stretch;
    flex-wrap: nowrap;
    width: 100%;
  }
  .place {
    flex: 1 1 calc(100% - 20px);
    max-width: calc(100% - 20px);
  }
}

</style>
