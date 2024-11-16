<template>
    <div class="events-page">
      <h1>Events</h1>
  
      <!-- Event 1 with Place Information -->
      <EventCard
        title="Bubble Tea Book Club"
        organizer="Ming's Bubble Tea"
        description="Mon: 9:00 PM"
        avatar-url="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSurYFf7p25tYNhg7WwfLGNtcepYWAzrg77QA&s"
        placeTitle="Ming's Bubble Tea"
        placeDescription="Bubble Tea and Waffles"
        :placeRating="4"
        placeMapsLink="https://maps.app.goo.gl/5dTnNqdJD5RJWngs6"
        placeImagePath="https://s3-media0.fl.yelpcdn.com/bphoto/laWJlvT5aDYTl-YWc42VIQ/348s.jpg"
        placePreviewImagePath="https://example.com/preview2.jpg"
        placeExtendedDescription="The ultimate destination for bubble tea lovers!"
        :placeExtraDetails="['Wide selection of flavors', 'Pet-friendly outdoor seating', 'Student discounts available']"
      />
  
      <!-- Event 2 without Place Information -->
      <EventCard
        title="Cat"
        organizer="Kibby"
        description="Cuddle with cats"
        avatar-url="https://i.natgeofe.com/n/4cebbf38-5df4-4ed0-864a-4ebeb64d33a4/NationalGeographic_1468962_3x4.jpg"
      />
  
      <!-- Event 3 with Place Information -->
      <EventCard
        title="Scribbles HIC Meeting"
        organizer="V"
        description=""
        avatar-url="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR-OB8qV6lOsaLdSoD38foSZzjtJ1NQkGKOjA&s"
        placeTitle="Scribbles Coffee"
        placeDescription=""
        :placeRating="5"
        placeMapsLink="https://maps.app.goo.gl/ipvMbZxBwTJ2mRMm6"
        placeImagePath=""
        placeExtendedDescription=""
        :placeExtraDetails="['Hopefully this is enough for now', '', '']"
      />
  
      <!-- Standalone PlaceCard (without Event) -->
      <h1>Popular Places</h1>
      <PlaceCard
        title="Place"
        description=""
        :rating="1"
        mapsLink=""
        imagePath=""
        previewImagePath="https://example.com/library-preview.jpg"
        extendedDescription=""
        :extraDetails="['', '', '']"
      />
    </div>
  </template>
  
  <script>
  import EventCard from '/src/components/EventCard.vue';
  import PlaceCard from '/src/components/PlaceCard.vue';
  
  export default {
    components: {
      EventCard,
      PlaceCard,
    },
  };
  </script>
  
  <style scoped>
  .events-page {
    padding: 20px;
  }
  </style>
  