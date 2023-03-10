<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1 class="titulo-secao">Tipos de pessoa</h1>
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
                  <th></th>
                </tr>
                <tr v-for="(item, index) in lista" v-bind:key="item.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ item.tipo }}</td>
                  <td>
                    <button
                      v-on:click="excluiTipoPessoa(index)"
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
            <h4 class="modal-title">ADICIONAR TIPO DE PESSOA</h4>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger" v-if="msgs.length > 0">
              <p v-for="msg in msgs" v-bind:key="msgs">{{ msg }}</p>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="tipo">Tipo de pessoa: *</label>
                  <input
                    type="text"
                    name="tipo"
                    id="tipo"
                    placeholder
                    class="form-control"
                    v-model="tipopessoa.tipo"
                    @keyup.13="adicionaTipoPessoa"
                    v-validate="'required'"
                  />
                  <span>{{ errors.first("tipo") }}</span>
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
              @click="adicionaTipoPessoa"
              class="btn btn-primary"
              :disabled="ativarBotao"
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
      tipopessoa: {
        id: "",
        tipo: ""
      },
      lista: [],
      msgs: []
    };
  },
  mounted() {
    this.exibeTipo_pessoa();
    this.$nextTick(function() {
      window.addEventListener("keyup", event => {
        if (event.keyCode === 187) {
          this.abreFormAdicionar();
        }
      });
    });
  },
  computed: {
    ativarBotao() {
      if (this.tipopessoa.tipo.length > 3) {
        return this.inativo <= false;
      }
      return this.inativo <= true;
    }
  },
  methods: {
    exibeTipo_pessoa() {
      axios.get("http://localhost:8000/api/tipopessoa").then(response => {
        this.lista = response.data;
      });
    },
    abreFormAdicionar() {
      $("#modal_novo").modal("show");
      $("#modal_novo").on("shown.bs.modal", function() {
        $("#tipo").trigger("focus");
      });
    },
    adicionaTipoPessoa() {
      axios
        .post("http://localhost:8000/api/tipopessoa", {
          tipo: this.tipopessoa.tipo
        })
        .then(response => {
          this.lista.push(response.data);
          this.msgs.push(response.data.tipo + " cadastrado com sucesso!");
          this.limpaCampos();
          $("#tipo").trigger("focus");
        })
        .catch(error => {
          this.msgs.push(error.response.data.errors);
        });
    },
    excluiTipoPessoa(index) {
      let conf = confirm(
        "Deseja realmente excluir " + this.lista[index].tipo + "?"
      );
      if (conf === true) {
        axios
          .delete(
            "http://localhost:8000/api/tipopessoa/" + this.lista[index].id
          )
          .then(this.lista.splice(index, 1))
          .catch(error => {
            this.msgs.push(error.response.data.errors);
          });
      }
    },
    limpaCampos() {
      this.esconde_alerta();
      this.errors.clear();
      this.tipopessoa.tipo = "";
      $(".form-control.invalido").removeClass("invalido");
    },
    esconde_alerta() {
      setTimeout(() => {
        $(".alert").alert("close");
      }, 7000);
    },
    fecharModal() {
      this.limpaCampos();
      $("#modal_novo").modal("hide");
    }
  }
};
</script>
