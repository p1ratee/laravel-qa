import policies from './policies';
export default {
    install(Vue, options) {
        Vue.prototype.authorize = function (policy, model) {
            if (!window.Auth.signedIn) return false;
            if (typeof policy == 'string' && typeof model == 'object') {
                const user = window.Auth.user;
                return policies.modify(user, model);
                // return policies[policy](user, model); is the same 
                // return policies['accept'](user, model);  with given policy
            }
        };
        Vue.prototype.signedIn = window.Auth.signedIn;
    }
}
