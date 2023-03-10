<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1 class="titulo-secao">Ordens de Serviço</h1>
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
                  <th>No.</th>
                  <th>Cliente</th>
                  <th>Navio</th>
                  <th>Tipo de Serviço</th>
                  <th>Descrição</th>
                  <th>Locais</th>
                  <th>Horário de Saída</th>
                  <th>Horário de término</th>
                  <th>Motorista</th>
                  <th>Status</th>
                </tr>
                <tr v-for="(os, index) in lista" :key="os.id">
                  <td>{{ index + 1 }}</td>
                  <td>
                    {{ os.cliente }}
                  </td>
                  <td>
                    {{ os.navio }}
                  </td>
                  <td>
                    {{ os.tipo_servico }}
                  </td>
                  <td>
                    {{ os.descricao_servico }}
                  </td>
                  <td>
                    {{ os.locais }}
                  </td>
                  <td>
                    {{ os.data_saida }}
                  </td>
                  <td>
                    {{ os.hora_saida }}
                  </td>
                  <td>
                    {{ os.data_termino }}
                  </td>
                  <td>
                    {{ os.hora_termino }}
                  </td>
                  <td>
                    {{ os.km_inicial }}
                  </td>
                  <td>
                    {{ os.km_final }}
                  </td>
                  <td>
                    {{ os.motorista }}
                  </td>
                  <td>
                    {{ os.status }}
                  </td>
                  <td>
                    <button
                      @click="initUpdate(index)"
                      class="btn btn-success btn-xs"
                    >
                      Editar
                    </button>
                    <button
                      @click="excluiOs(index)"
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
    <div class="modal fade" tabindex="-1" role="dialog" id="nova_os_modal">
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
            <h4 class="modal-title">Adicionar nova OS</h4>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger" v-if="errors.length > 0">
              <ul>
                <li v-for="error in errors">{{ error }}</li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group col-md-6">
                  <label for="cliente">Cliente:</label>
                  <select
                    name="cliente"
                    id="cliente"
                    v-model="pessoa.id_pessoa"
                  >
                    <option disabled value>Selecione uma opção</option>
                    <option
                      v-for="item in pessoa"
                      :key="item.id"
                      :value="item.id"
                      >{{ item.apelido }}</option
                    >
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="navio">Navio:</label>
                  <select
                    name="navio"
                    id="navio"
                    v-model="navio.id_navio"
                  >
                    <option disabled value>Selecione uma opção</option>
                    <option
                      v-for="item in navio"
                      :key="item.id"
                      :value="item.id"
                      >{{ item.nome }}</option
                    >
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="tipo_servico">Serviço:</label>
                  <input
                    type="text"
                    name="tipo_servico"
                    id="tipo_servico"
                    placeholder="Tipo de serviço"
                    class="form-control"
                    v-model="os.tipo_servico"
                  />
                </div>
                <div class="form-group col-md-12">
                  <label for="descricao_servico">Descrição:</label>
                  <textarea
                    name="descricao_servico"
                    id="descricao_servico"
                    cols="30"
                    rows="5"
                    class="form-control"
                    placeholder="Descrição do serviço"
                    v-model="os.descricao_servico"
                  ></textarea>
                </div>
                <div class="form-group">
                  <label for="Locais">Locais:</label>
                  <textarea
                    name="locais"
                    id="locais"
                    cols="30"
                    rows="5"
                    class="form-control"
                    placeholder="Adicione os locais de saída, destino e as paradas"
                    v-model="os.locais"
                  ></textarea>
                </div>
                <div class="form-group">
                  <label for="data_saida">Data de Saída:</label>
                  <input
                    type="text"
                    name="data_saida"
                    id="data_saida"
                    placeholder="Data de início do serviço"
                    class="form-control"
                    v-model="os.data_inicio"
                    v-mask="'##/##/####'"
                  />
                </div>
                <div class="form-group">
                  <label for="hora_saida">Hora de saída:</label>
                  <input
                    type="text"
                    name="hora_saida"
                    id="hora_saida"
                    placeholder="Horario de saída do carro"
                    class="form-control"
                    v-model="os.hora_inicio"
                    v-mask="'##:##'"
                  />
                </div>
                <div class="form-group">
                  <label for="data_termino">Data de Término:</label>
                  <input
                    type="text"
                    name="data_termino"
                    id="data_termino"
                    placeholder="Data de término do serviço"
                    class="form-control"
                    v-model="os.data_termino"
                    v-mask="'##/##/####'"
                  />
                </div>
                <div class="form-group">
                  <label for="hora_termino">Hora de Término:</label>
                  <input
                    type="text"
                    name="hora_termino"
                    id="hora_termino"
                    placeholder="Horario de termino do serviçoo"
                    class="form-control"
                    v-model="os.hora_termino"
                    v-mask="'##:##'"
                  />
                </div>
                <div class="form-group">
                  <label for="km_inicial">KM inicial:</label>
                  <input
                    type="text"
                    name="km_inicial"
                    id="km_inicial"
                    placeholder="KM do veículo ao início da viagem"
                    class="form-control"
                    v-model="os.km_inicial"
                  />
                </div>
                <div class="form-group">
                  <label for="km_final">KM final:</label>
                  <input
                    type="text"
                    name="km_final"
                    id="km_final"
                    placeholder="KM final do veículo ao término da viagem"
                    class="form-control"
                    v-model="os.km_final"
                  />
                </div>
                <div class="form-group">
                  <label for="motorista">Motorista:</label>
                  <input
                    type="text"
                    name="motorista"
                    id="motorista"
                    placeholder=""
                    class="form-control"
                    v-model="os.motorista"
                  />
                </div>
                <div class="form-group">
                  <label for="ststus">Status do Trabalho:</label>
                  <input
                    type="text"
                    name="status"
                    id="status"
                    placeholder=""
                    class="form-control"
                    v-model="os.status"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
            <button type="button" @click="criaOS" class="btn btn-primary">
              Submit
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
  //props: ["oss"],
  data() {
    return {
      os: {
        cliente: "",
        navio: "",
        tipo_servico: "",
        descricao_servico: "",
        locais: "",
        data_hora_saida: "",
        data_hora_termino: "",
        km_inicial: "",
        km_final: "",
        motorista: "",
        status_os: "",
      },
      pessoa:{},
      navio:{},
      editar: {},
      msgs: [],
      lista: []
    };
  },
  mounted() {
    this.$nextTick(function() {
      window.addEventListener("keyup", event => {
        if (event.keyCode === 187) {
          this.abreFormAdicionar();
        }
      });
    });
    this.exibeOss();
    this.exibePessoas();
    this.exibeNavios();
  },
  methods: {
    abreFormAdicionar() {
      this.errors = [];
      $("#nova_os_modal").modal("show");
    },
    criaOS() {
      axios
        .post("/oss", {
          id_pessoa: this.pessoa.id_pessoa,
          id_navio: this.navio.id_navio,
          tipo_servico: this.os.tipo_servico,
          descricao_servico: this.os.descricao_servico,
          locais: this.os.lcoais,
          data_hora_inicio: "2019-05-02 15:00:00",
          data_hora_termino: "2019-05-02 16:00:00",
          km_inicial: this.os.km_inicial,
          km_final: this.os.km_final,
          motorista: this.os.motorista,
          status_os: this.os.status,
        })
        .then((response) => {
          this.reset();

          //this.oss.push(response.data.os);

          $("#nova_os_modal").modal("hide");
        })
        .catch((error) => {
          this.errors = [];
          if (error.response.data.errors.name) {
            this.errors.push(error.response.data.errors.name[0]);
          }

          if (error.response.data.errors.description) {
            this.errors.push(error.response.data.errors.description[0]);
          }
        });
    },
    reset() {
      (this.os.cliente = ""),
      (this.os.navio = ""),
      (this.os.tipo_servico = ""),
      (this.os.descricao_servico = ""),
      (this.os.locais = ""),
      (this.os.data_inicio = ""),
      (this.os.hora_inicio = ""),
      (this.os.data_termino = ""),
      (this.os.hora_termino = ""),
      (this.os.km_inicial = ""),
      (this.os.km_final = ""),
      (this.os.motorista = ""),
      (this.os.status = "");
    },
    exibeOss() {
      axios.get("http://localhost:8000/api/oss").then((response) => {
        this.lista = response.data;
      });
    },
    exibePessoas() {
      axios.get("http://localhost:8000/api/pessoa").then(response => {
        this.pessoa = response.data;
      });
    },
    exibeNavios(){
      axios.get("http://localhost:8000/api/navios").then(response => {
        this.navio = response.data;
      });
    },
    excluiPessoa(index) {
      let conf = confirm("Deseja mesmo remover esta os?" );
      if (conf === true) {
        axios
          .delete("http://localhost:8000/api/oss/" + this .lista[index].id)
          .then(response => {
            this.lista.splice(index, 1);
          })
          .catch(error => {});
      }
    }
  },
};
</script>
