<template>
<div class="lista">
    <div class="mx-3 mb-4">
        <input type="text" v-model="pesquisa" class="form-control" placeholder="Pesquisar..." @keyup.enter="fetchContatos" />
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item" v-if="loading">Carregando...</li>
        <template v-else-if="contatos.length">
        <li 
            class="list-group-item d-flex align-items-center" 
            v-for="(contato, index) in contatos" :key="index" @click="contato_selected = contato">
            <div class="lista__avatar d-flex align-items-center justify-content-center">
                {{contato.nome.charAt(0).toUpperCase()}}
            </div>
            <div class="lista__nome">{{contato.nome}}</div>            
        </li>
        </template>
        <li v-else class="list-group-item">Nenhum contato encontrado em sua agenda!</li>
    </ul>
    <transition name="sidebar" mode="out-in">
        <SidebarAlteraContato v-if="Object.keys(contato_selected).length" @atualiza-contato="atualizaContato" :contato_selected.sync="contato_selected" />
    </transition>
        <BackDrop v-if="Object.keys(contato_selected).length" @click-event="contato_selected = {}"/>

</div>
</template>

<script>
import SidebarAlteraContato from "./SidebarAlteraContato"
export default {
    props: {
        novo_contato: {
            type: Object
        }
    },
    components: {
        SidebarAlteraContato
    },
    data() {
        return {
            pesquisa:"",
            contatos: [],
            contato_selected: {},
            loading: false
        }
    },
    watch: {
        novo_contato() {
            this.adicionaContato();            
        }
    },
    methods: {
        fetchContatos() {
            this.loading = true;

            let params = {};

            if(this.pesquisa) {
                params.filtro = this.pesquisa;
            }

            axios.get("/contatos", {
                params
            })
            .then(response => {
                this.contatos = response.data;
            })
            .catch(error => {
                if(error.response.data.errors?.length) {

                }
            })
            .finally(() => {
                this.loading = false;
            })
        },
        adicionaContato() {
            this.contatos.unshift(this.novo_contato);
        },
        atualizaContato(contato) {
            const index = this.contatos.findIndex(item => item.id == contato.id);
            this.contatos[index] = contato;
        },
    },
    created() {
        this.fetchContatos();
    }
}
</script>

<style lang="scss">
.list-group {
    &-item {
        transition: all .3s;
        cursor: pointer;
        &:hover {
            background-color: rgba(0,0,0,0.1);
        }
    }
}

.lista {
    &__avatar {
        margin-right: .6rem;
        height: 1.6rem;
        width: 1.6rem;
        border-radius: 50%;
        background-color: #1515;
        color: #FFF;
    }
}
</style>