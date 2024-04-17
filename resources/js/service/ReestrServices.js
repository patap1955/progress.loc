import axios from "axios";
export default class ReestrServices {
    async getReestr() {

        return await fetch('/api/reestr', {
            method: 'GET',
        })
            .then((res) => res.json())
    }
}
