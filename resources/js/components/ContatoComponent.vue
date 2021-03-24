<template>
    <div class="container my-5">
        <h3 class="text-center">Agenda Shipsmart</h3>
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Meus Contatos
                        <button type="button" class="btn btn-sm btn-success" @click="showSidebarNovoContato = true">
                            <i class="fas fa-plus"></i> Novo Contato
                        </button>
                    </div>

                    <div class="card-body px-0">
                        <ListaContatos :novo_contato="novoContatoAdicionado" />
                    </div>
                </div>
            </div>
        </div>
        
        <transition name="sidebar" mode="out-in">
            <SidebarNovoContato v-if="showSidebarNovoContato" @close-sidebar="showSidebarNovoContato = false" @novo-contato="novoContatoAdicionado = $event" />
        </transition>
        <BackDrop v-if="showSidebarNovoContato" @click-event="showSidebarNovoContato = null"/>

    </div>
</template>

<script>
    import ListaContatos from './partials/ListaContatos';
    import SidebarNovoContato from "./partials/SidebarNovoContato";
    export default {
        components: {
            ListaContatos,
            SidebarNovoContato
        },
        data() {
            return {
                showSidebarNovoContato:false,
                novoContatoAdicionado: {}
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
