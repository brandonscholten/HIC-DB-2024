import { createRouter, createWebHistory } from 'vue-router'
import Landing from '../views/Landing.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'landing',
      component: Landing
    },
    {
      path: '/places',
      name: 'places',
      component: () => import('../views/Places.vue')
    }, 
    {
      path: '/events',
      name: 'events',
      component: () => import('../views/Events.vue')
    },
    {
      path: '/profile',
      name: 'profile',
      component: () => import('../views/Profile.vue')
    },
    {
      path: '/edit-profile',
      name: 'edit-profile',
      component: () => import('../views/EditProfile.vue')
    },
    {
      path: '/favorite-places',
      name: 'favorite-places',
      component: () => import('../views/FavoritePlaces.vue')
    },
    {
      path: '/my-events',
      name: 'my-events',
      component: () => import('../views/MyEvents.vue')
    },
    {
      path: '/demo-places', // Demo Scene (Testing Cards)
      name: 'demo-places',
      component: () => import('../views/DemoPlaces.vue')
    }
  ]
})

export default router
