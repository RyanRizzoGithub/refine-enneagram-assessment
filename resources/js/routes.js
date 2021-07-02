import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/js/pages/Home';
import Buy from '@/js/pages/Buy';
import Type from '@/js/pages/Type';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Buy,
            props: true,
            meta: {
                title: `${process.env.MIX_APP_NAME}`,
            }
        },
        {
            path: '/assessment',
            name: 'assessment',
            component: Home,
            props: true,
            meta: {
                title: `Assessment | ${process.env.MIX_APP_NAME}`,
            }
        },
        {
            path: '/type1',
            name: 'type1',
            component: Type,
            props: true,
            meta: {
                title: `Type 1 | ${process.env.MIX_APP_NAME}`,
            }
        },
        {
            path: '/type2',
            name: 'type2',
            component: Type,
            props: true,
            meta: {
                title: `Type 2 | ${process.env.MIX_APP_NAME}`,
            }
        },
        {
            path: '/type3',
            name: 'type3',
            component: Type,
            props: true,
            meta: {
                title: `Type 3 | ${process.env.MIX_APP_NAME}`,
            }
        },
        {
            path: '/type4',
            name: 'type4',
            component: Type,
            props: true,
            meta: {
                title: `Type 4 | ${process.env.MIX_APP_NAME}`,
            }
        },
        {
            path: '/type5',
            name: 'type5',
            component: Type,
            props: true,
            meta: {
                title: `Type 5 | ${process.env.MIX_APP_NAME}`,
            }
        },
        {
            path: '/type6',
            name: 'type6',
            component: Type,
            props: true,
            meta: {
                title: `Type 6 | ${process.env.MIX_APP_NAME}`,
            }
        },
        {
            path: '/type7',
            name: 'type7',
            component: Type,
            props: true,
            meta: {
                title: `Type 7 | ${process.env.MIX_APP_NAME}`,
            }
        },
        {
            path: '/type8',
            name: 'type8',
            component: Type,
            props: true,
            meta: {
                title: `Type 8 | ${process.env.MIX_APP_NAME}`,
            }
        },
        {
            path: '/type9',
            name: 'type9',
            component: Type,
            props: true,
            meta: {
                title: `Type 9 | ${process.env.MIX_APP_NAME}`,
            }
        },
        {
            path: '*',
            redirect: '/'
        }
    ],
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        }

        return { x: 0, y: 0 };
    },
});

// This callback runs before every route change, including on page load.
router.beforeEach((to, from, next) => {
  // This goes through the matched routes from last to first, finding the closest route with a title.
  // eg. if we have /some/deep/nested/route and /some, /deep, and /nested have titles, nested's will be chosen.
  const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);

  // Find the nearest route element with meta tags.
  const nearestWithMeta = to.matched.slice().reverse().find(r => r.meta && r.meta.metaTags);
  const previousNearestWithMeta = from.matched.slice().reverse().find(r => r.meta && r.meta.metaTags);

  // If a route with a title was found, set the document (page) title to that value.
  if(nearestWithTitle) document.title = nearestWithTitle.meta.title;

  // Remove any stale meta tags from the document using the key attribute we set below.
  Array.from(document.querySelectorAll('[data-vue-router-controlled]')).map(el => el.parentNode.removeChild(el));

  // Skip rendering meta tags if there are none.
  if(!nearestWithMeta) return next();

  // Turn the meta tag definitions into actual elements in the head.
  nearestWithMeta.meta.metaTags.map(tagDef => {
    const tag = document.createElement('meta');

    Object.keys(tagDef).forEach(key => {
      tag.setAttribute(key, tagDef[key]);
    });

    // We use this to track which meta tags we create, so we don't interfere with other ones.
    tag.setAttribute('data-vue-router-controlled', '');

    return tag;
  })
  // Add the meta tags to the document head.
  .forEach(tag => document.head.appendChild(tag));

  next();
});


export default router;
