class ApiClient {
    constructor (baseUrl){
        this.baseUrl = baseUrl;
    }

    async get(endpoint) {
        const options = {
            method : 'GET',
            header : {
                'Content-Type' : 'application/json',
            }
        }

        const urlHttp = this.baseUrl + endpoint;

        try {
            const response = await fetch(urlHttp, options);
            
            if(!response.ok){
                throw new Error('HTTP error, status = '+ response.status);
            }

            return response.json();
        } catch (error){
            console.error('Error fetching data:', error);
            throw error;
        }
    }

    async post(endpoint, data) {
        const options = {
            method : 'POST',
            body : data,
        }

        const urlHttp = this.baseUrl + endpoint ;
        console.log(data);

        try {
            const response = await fetch(urlHttp, options);
            
            if(!response.ok){
                throw new Error('HTTP error, status = '+ response.status);
            }

            return response.json();
        } catch (error){
            console.error('Error fetching data:', error);
            throw error;
        }
    }

    async put(endpoint, data) {
        const options = {
            method : 'POST',
            body : data,
        }

        const urlHttp = this.baseUrl + endpoint ;
        console.log(data);

        try {
            const response = await fetch(urlHttp, options);
            
            if(!response.ok){
                throw new Error('HTTP error, status = '+ response.status);
            }

            return response.json();
        } catch (error){
            console.error('Error fetching data:', error);
        }
    }
}