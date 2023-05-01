<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1 class="titulo-secao">Tipos de Serviço</h1>
            <button
              @click="abreFormAdicionar()"
              class="btn btn-primary btn-xs pull-right"
            >
              (+)Adicionar
            </button>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped table-responsive">
              <tbody>
                <tr>
                  <th></th>
                  <th>Tipo</th>
                  <th>Descrição Padrão</th>
                  <td></td>
                </tr>
                <tr v-for="(item, index) in lista" v-bind:key="item.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ item.tipo }}</td>
                  <td>{{ item.descricao }}</td>
                  <td>
                    <button
                      @click="abreEditarModal(index)"
                      class="btn btn-success btn-xs"
                    >
                      Editar
                    </button>
                    <button
                      v-on:click="excluiTiposervico(index)"
                      class="btn btn-danger btn-xs"
                    >
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
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">ADICIONAR TIPO DE SERVIÇO</h4>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger" v-if="msgs.length > 0">
              <p v-for="msg in msgs" v-bind:key="msgs">{{ msg }}</p>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="tipo">Tipo:</label>
                  <input
                    type="text"
                    name="tipo"
                    id="tipo"
                    class="form-control"
                    v-model="tiposervico.tipo"
                    v-validate="'required'"
                  />
                  <span>{{ errors.first("tipo") }}</span>
                </div>
                <div class="form-group">
                  <label for="descricao">Descrição:</label>
                  <textarea
                    type="text"
                    name="descricao"
                    id="descricao"
                    placeholder="Descriçao do serviço"
                    class="form-control"
                    col="30"
                    rows="5"
                    v-model="tiposervico.descricao"
                  ></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              @click="fecharModal"
              @keyup.27="fecharModal"
              class="btn btn-default"
            >
              Fechar
            </button>
            <button
              type="button"
              @click="adicionaTiposervico"
              @keyup.13="adicionaTiposervico"
              class="btn btn-primary"
              :disabled="ativaBotao"
            >
              Salvar
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_editar">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">EDITAR TIPO DE SERVIÇO</h4>
            </div>
            <div class="modal-body">
              <div class="alert alert-danger" v-if="msgs.length > 0">
                <p v-for="msg in msgs" v-bind:key="msgs">{{ msg }}</p>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <input                      
                      type="text"
                      name="tipo"
                      id="tipo"
                      class="form-control"
                      v-model="editartiposervico.tipo"
                      v-validate="'required'"
                    />
                    <span>{{ errors.first("tipo") }}</span>
                  </div>
                  <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea
                      type="text"
                      name="descricao"
                      id="descricao"
                      placeholder="Descriçao do serviço"
                      class="form-control"
                      col="30"
                      rows="5"
                      v-model="editartiposervico.descricao"
                    ></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                @click="fecharModal"
                @keyup.27="fecharModal"
                class="btn btn-default"
              >
                Cancelar
              </button>
              <button
                type="button"
                @click="atualizaTiposervico"
                @keyup.13="atualizaTiposervico"
                class="btn btn-primary"
                :disabled="ativaBotao"
              >
                Salvar
              </button>
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
      tiposervico: {
        id: "",
        tipo: "",
        descricao: ""
      },
      editartiposervico:{
        id: "",
        tipo: "",
        descricao: ""
      },
      msgs: [],
      lista: [],
    };
  },
  mounted() {
    this.exibeTipo_servico();
    this.$nextTick(function() {
      window.addEventListener("keyup", event => {
        if (event.keyCode === 187) {
          this.abreFormAdicionar();
        }
      });
    });
  },
  computed: {
    ativaBotao() {
      if (this.tiposervico.tipo.length > 3) {
        return this.inativo <= false;
      }
      if (this.editartiposervico.tipo.length > 3){
        return this.inativo <= false;
      }
      return this.inativo <= true;
    }
  },
  methods: {
    exibeTipo_servico() {
      axios.get("http://localhost:8000/api/tiposervico").then(response => {
        this.lista = response.data;
      });
    },
    abreFormAdicionar() {
      $("#modal_novo").modal("show");
      $("#modal_novo").on("shown.bs.modal", function() {
        $("#tipo").trigger("focus");
      });
    },
    abreEditarModal(index) {
      //this.errors = [];
      $("#modal_editar").modal("show");
      console.log (this.lista[index])
      this.editartiposervico = this.lista[index];
    },
    adicionaTiposervico() {
      axios
        .post("http://localhost:8000/api/tiposervico", {
          tipo: this.tiposervico.tipo,
          descricao: this.tiposervico.descricao
        })
        .then(response => {
          this.lista.push(response.data);
          this.msgs.push(response.data.tipo + " cadastrado com sucesso!");
          this.limpaCampos();
        })
        .catch(error => {
          this.msgs.push(error.response.data.errors);
        });
    },
    atualizaTiposervico() {
      axios
        .patch("http://localhost:8000/api/tiposervico/" + this.editartiposervico.id, {
          id: this.editartiposervico.id,
          tipo: this.editartiposervico.tipo,
          descricao: this.editartiposervico.descricao
        })
        .then(response => {
          $("#editar_modal").modal("hide");
        })
        .catch(error => {
          //this.errors = [];
          if (error.response.data.errors.name) {
            this.errors.push(error.response.data.errors.name[0]);
          }
          if (error.response.data.errors.description) {
            this.errors.push(error.response.data.errors.description[0]);
          }
        });
    },
    excluiTiposervico(index) {
      let conf = confirm(
        "Deseja realmente excluir " + this.lista[index].tipo + "?"
      );
      if (conf === true) {
        axios
          .delete(
            "http://localhost:8000/api/tiposervico/" + this.lista[index].id
          )
          .then(this.lista.splice(index, 1))
          .catch(error => {
            this.msgs.push(error.response.data.errors);
          });
      }
    },
    limpaCampos() {
      this.errors.clear();
      this.tiposervico.tipo = "";
      $("#tipo").trigger("focus");
    },
    fecharModal() {
      this.limpaCampos();
      $("#modal_novo").modal("hide");
    }
  }
};
</script>
