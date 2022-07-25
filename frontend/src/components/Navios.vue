<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1 class="titulo-secao">Navios</h1>
            <button @click="abreFormAdicionar()" class="btn btn-primary btn-xs pull-right">
              (+)Novo
            </button>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped table-responsive">
              <tbody>
                <tr>
                  <th></th>
                  <th>Nome </th>
                  <th>Bandeira</th>
                  <th>Porto de Registro</th>
                  <td></td>
                </tr>
                <tr v-for="(item, index) in lista" v-bind:key="item.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ item.nome_navio }}</td>
                  <td>{{ item.bandeira }}</td>
                  <td>{{ item.porto_registro }}</td>
                  <td>
                    <button v-on:click="excluiNavio(index)" class="btn btn-danger btn-xs">
                      Excluir
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_novo">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">ADICIONAR NAVIO</h4>
          </div>
          <div class="modal-body">
            <!-- <div class="alert alert-danger" v-if="msgs.length > 0">
              <p v-for="msg in msgs" v-bind:key="msg">{{ msg }}</p>
            </div> -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="tipo">Nome do Navio:</label>
                  <input type="text" name="nome" id="nome" class="form-control" v-model="navio.nome_navio"
                    @keyup.13="adicionaNavio" v-validate="'required'" />
                  <span>{{ errors.first('nome') }}</span>
                </div>
                <div class="form-group">
                  <label for="descricao">Bandeira:</label>
                  <input type="text" name="bandeira" id="bandeira" placeholder="Bandeira do Navio" class="form-control"
                    v-model="navio.bandeira" v-validate="'required'"/>
                </div>
                <div class="form-group">
                  <label for="porto_registro">Porto de registro:</label>
                  <input type="text" name="porto_registro" id="porto_registro" placeholder="Porto de registro" class="form-control"
                    v-model="navio.porto_registro"/>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" @click="fecharModal" @keyup.27="fecharModal" class="btn btn-default">Fechar</button>
            <button type="button" @click="adicionaNavio" @keyup.13="adicionaNavio" class="btn btn-primary" :disabled="ativarBotao">Salvar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </div>
</template>
<script>
import axios from "axios";
import $ from "jquery";
export default {
  data() {
    return {
      inativo: true,
      navio: {
        id: '',
        nome_navio: '',
        bandeira: '',
        porto_registro: ''
      },
      lista: [],
      msgs: []
    };
  },
  mounted() {
    //this.exibeTipo_servico();
    this.$nextTick(function () {
      window.addEventListener("keyup", event => {
        if (event.keyCode === 187) {
          this.abreFormAdicionar();
        }
      });
    });
  },
  computed:{
    // ativarBotao() {
    //   if (this.navio.nome.length > 3 && this.navio.bandeira){
    //     return (this.inativo <= false)
    //   }
    //   return (this.inativo <= true)
    // }
  },
  methods: {
    exibeNavios() {
      axios.get("http://localhost:8000/api/navios").then(response => {
        console.log(response);
        //this.lista = response.data;
      });
    },
    abreFormAdicionar() {
      $("#modal_novo").modal("show");
      $("#modal_novo").on("shown.bs.modal", function () {
        $("#tipo").trigger("focus");
      });
    },
    adicionaNavio() {
      axios
        .post("http://localhost:8000/api/navios", {
          nome_navio: this.navio.nome_navio,
          bandeira: this.navio.bandeira,
          porto_registro: this.navio.porto_registro
        })
        .then(response => {
          this.lista.push(response.data);
          this.msgs.push(response.data.tipo +' cadastrado com sucesso!');
          this.limpaCampos();
        })
        .catch(error => {
          this.msgs.push(error.response.data.errors);
        });
    },
    excluiNavio(index) {
      let conf = confirm(
        "Deseja realmente excluir " + this.lista[index].tipo + "?"
      );
      if (conf === true) {
        axios.delete(
          "http://localhost:8000/api/navios/" + this.lista[index].id
        )
        .then(this.lista.splice(index, 1))
        .catch(error => {
          this.errors.push(error.response.data.errors);
        });
      }
    },
    limpaCampos() {
      this.errors.clear();
      this.navio.tipo = '';
      $("#tipo").trigger("focus");
    },
    fecharModal() {
      this.limpaCampos();
      $("#modal_novo").modal("hide");
    }
  }
};
</script>
