import Home from './components/admin/Home.vue';
import Role from './components/admin/role/index.vue';
import User from './components/admin/user/index.vue';
import Centa from './components/admin/centa/index.vue';
import Branch from './components/admin/branch/index.vue';
import Attendance from './components/admin/attendance/index.vue';
import NotFound from './components/admin/Error404.vue';

export const routes = [

  { path: '/', component: Home, },
  { path: '/roles', component: Role, },
  { path: '/users', component: User, },
  { path: '/centa', component: Centa, },
  { path: '/branches', component: Branch, },
  { path: '/attendance', component: Attendance, },
  { path: '*', component: NotFound, },
]