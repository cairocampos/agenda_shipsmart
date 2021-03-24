<template>
    <div class="sidebar d-flex flex-column safari_only">
        <div class="content custom__scrollbar d-flex flex-column pb-0">
            <div class="sidebar__header mb-3 d-flex align-items-center justify-content-between">

                <button type="button" class="btn btn-link text-default p-0" @click="closeSidebar">
                    <i class="fas fa-arrow-left"></i>
                    Fechar
                </button>

            </div>


            <div class="sidebar__body pb-4">

                <form class="form" @submit.prevent="salvaContato">
                    <small class="text-muted">Dados do Contato</small>
                    <div class="form-group">
                        <label for="">Nome</label>
                        <input type="text" class="form-control" v-model="data.nome" required>
                        <small class="text-danger" v-if="errors.has('nome')">
                            Campo nome é obrigatório
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="">Telefone</label>
                        <input type="text" class="form-control" v-model="data.telefone">
                        <small class="text-danger" v-if="errors.has('telefone')">
                            Campo telefone é obrigatório
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" v-model="data.email">
                        <small class="text-danger" v-if="errors.has('email')">
                            Campo email é obrigatório
                        </small>
                    </div>

                    <hr>

                    <small class="text-muted">Endereço</small>
                    <div class="form-group">
                        <label for="inputAddress">CEP</label>
                        <input type="text" class="form-control" v-model="data.cep">
                        <small class="text-danger" v-if="errors.has('cep')">
                            Campo CEP é obrigatório
                        </small>
                    </div>

                    <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" class="form-control" v-model="data.cidade" placeholder="Ex: São Paulo">
                        <small class="text-danger" v-if="errors.has('cidade')">
                            Campo cidade é obrigatório
                        </small>
                    </div>

                    <div class="form-group">
                        <label>Bairro</label>
                        <input type="text" class="form-control" v-model="data.bairro">
                        <small class="text-danger" v-if="errors.has('bairro')">
                            Campo bairro é obrigatório
                        </small>
                    </div>

                    <div class="form-group">
                        <label>Logradouro</label>
                        <input type="text" class="form-control" v-model="data.logradouro" placeholder="Ex: Avenida Camaleão">
                        <small class="text-danger" v-if="errors.has('logradouro')">
                            Campo logradouro é obrigatório
                        </small>
                    </div>


                    <div class="form-row d-flex">
                        <div class="form-group col-md-6">
                            <label for="">Número</label>
                            <input type="text" class="form-control" v-model="data.numero">
                            <small class="text-danger" v-if="errors.has('numero')">
                                Campo numero é obrigatório
                            </small>
                        </div>
                        <div class="form-group col-md-6" style="margin-left:8px;">
                            <label>Estado</label>
                            <select name="" id="" class="form-control" v-model="data.estado">
                                <option value="">Selecione...</option>
                                <option :value="estado.id" v-for="estado in estados" :key="estado.id">
                                    {{estado.sigla}}
                                </option>
                            </select>
                            <small class="text-danger" v-if="errors.has('estado')">
                                Campo estado é obrigatório
                            </small>
                        </div>
                    </div>

                    <div class="form-group d-flex justify-content-end my-5">
                        <button type="submit" class="btn btn-block btn-success">
                            <i class="fas fa-check"></i>
                            Salvar
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</template>

<script>
import Errors from '../../utils/Error'
export default {
    props: {
        contato_selected: {
            type:Object,
            required:true
        }
    },
    data() {
        return {
            errors: new Errors(),
            estados: [],
            data: {
                    nome:  this.contato_selected.nome,
                    telefone: this.contato_selected.telefone,
                    email: this.contato_selected.email,                
                    cep: this.contato_selected.cep,
                    cidade: this.contato_selected.cidade,
                    bairro: this.contato_selected.bairro,
                    logradouro: this.contato_selected.logradouro,
                    numero: this.contato_selected.numero,
                    estado: this.contato_selected.estado
            }
        }
    },
    watch: {
        "data.cep": function (cep) {
            if(cep.length == 8) {
                this.fetchCep();
            }
        }
    },
    methods: {
        fetchCep() {
            Swal.fire({
                text: "Buscando o endereço...",
                allowOutsideClick: false,
                onOpen: function () {
                    Swal.showLoading();
                }
            });
            axios.get(`https://cep.awesomeapi.com.br/json/${this.data.cep}`)
            .then(response => {
                if(response.data?.cep) {
                    const {cep, address, state, district, city} = response.data;
                    this.data.cep = cep;
                    this.data.logradouro = address;
                    this.data.estado = state;
                    this.data.bairro = district;
                    this.data.cidade = city;
                }

                Swal.fire({
                    icon:"success"
                })
            })
        },
        fetchEstados() {
            axios.get("/estados")
            .then(response => {
                this.estados = response.data;
            });
        },
        closeSidebar() {
            this.$emit('update:contato_selected', {});
        },
        salvaContato() {
            axios.put(`/contatos/${this.contato_selected.id}`, this.data)
            .then(response => {
                Swal.fire({
                    text:"Registro alterado com sucesso!",
                    icon:"success"
                })

                response.data.id = this.contato_selected.id;
                this.$emit("atualiza-contato", response.data)
                this.closeSidebar();
            })
            .catch(error => {
                if(error.response.data.errors) {
                    Swal.fire({
                        text:"Existem campos obrigatório que não foram preenchidos!",
                        icon:"warning"
                    })
                    this.errors.record(error.response.data.errors);
                }
            })
        }
    },
    created() {
        this.fetchEstados();
    }
}
</script>

<style lang="scss" scoped>
.sidebar {
    position: fixed;
    height: 100vh;
    width:500px;
    background-color: #FFF;
    top: 0;
    right: 0;
    box-shadow: 0 0 2px 2px rgba(0,0,0,0.2);
    transition: all .5s;
    z-index: 20;
    overflow: hidden;
    &__footer div {
        flex:1;
    }
}
.content {
    padding: 1.6rem;
    height: 100%;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
}

.form-group {
    margin-top: 1rem;
}
</style>