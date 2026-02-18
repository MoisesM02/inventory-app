export default function productSearch(searchRoute) {
    return {
        query: '',
        results: [],
        isLoading: false,

        search() {
            if (this.query.length < 2) {
                this.results = [];
                return;
            }

            this.isLoading = true;

            fetch(`${searchRoute}?q=${this.query}`)
                .then(response => response.json()) //Convierte en json la respuesta obtenida del endpoint
                .then(data => {
                    this.results = data; //Guarda la respuesta en la propiedad results del objeto
                    this.isLoading = false; // Ajusta la propiedad del objeto para determinar si está cargando
                });
        }
    }
}

