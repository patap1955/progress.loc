import axios from "axios";
export default class UserService {
    getAllUsers() {
        return  fetch('/api/users', {
            method: 'GET',

        })
            .then((res) => res.json())
    }

    getUser(id) {
        return fetch('/api/user/edit/' + id, {
            method: 'GET',
        }).then((res) => res.json())
    }

    updateUser(user) {
        return axios.post('/api/user/update/' + user.id, user)
    }

    addUser(user) {
        return axios.post('/api/user/add', user)
    }
}
