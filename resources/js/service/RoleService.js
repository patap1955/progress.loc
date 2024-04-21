export default class RoleService {
    getAllRoles() {
        return  fetch('/api/get-all-roles', {
            method: 'GET',
        })
            .then((res) => res.json())
    }
}
