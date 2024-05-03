import axios from "axios";
export default class UserService {
    auth() {
        return  fetch('/api/user-auth', {
            method: 'GET',

        })
            .then((res) => res.json())
    }
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

    deleteUser(id) {
        return axios.post('/api/user/delete/' +id)
    }
}
