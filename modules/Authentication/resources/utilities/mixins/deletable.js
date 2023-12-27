export const deletable = {
    methods: {
        destroy(url) {
            return new Promise((resolve) => {
                this.$confirm('¿Desea eliminar el registro?', 'Eliminar', {
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    type: 'warning'
                }).then(() => {
                    this.$http.delete(url)
                        .then(res => {
                            if(res.data.success) {
                                this.$message.success('Se eliminó correctamente el registro')
                                resolve()
                            }
                            else if (res.data.status){
                                this.$message.success(res.data.message)
                                resolve()
                            }
                        })
                        .catch(error => {
                            if (error.response.status === 500) {
                                this.$message.error('No se puede eliminar, contiene registros');
                            } else {
                                console.log(error.response.data.message)
                            }
                        })
                }).catch(error => {
                    console.log(error)
                });
            })
        },
    }
}