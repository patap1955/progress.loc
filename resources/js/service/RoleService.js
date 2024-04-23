import axios from "axios";

export default class RoleService {
    getAllRoles() {
        return  fetch('/api/get-all-roles', {
            method: 'GET',
        })
            .then((res) => res.json())
    }

    getRole(id) {
        return  fetch('/api/get-role/' + id, {
            method: 'GET',
        })
            .then((res) => res.json())
    }

    updateRole(role) {
        return axios.post('/api/role/update/' + role.id, role)
    }

    addRole(role) {
        return axios.post('/api/role/add', role)
    }
}
