<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1 class="titulo-secao">Ordens de Serviço</h1>
            <button
              @click="abreModalAdicionar()"
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
                  <th>Data e hora de saída</th>                  
                  <th>Data e hora de término</th>
                  <th>Km inicial</th>
                  <th>Km final</th>
                  <th>Motorista</th>
                  <th>Status</th>
                  <th>Ações</th>
                </tr>
                <tr v-for="(os, index) in lista" :key="os.id">
                  <td>
                    {{ os.id }}
                  </td>
                  <td>
                    {{ os.apelido }}
                  </td>
                  <td>
                    {{ os.nome }}
                  </td>
                  <td>
                    {{ os.tipo }}
                  </td>
                  <td>
                    {{ os.descricao_servico }}
                  </td>
                  <td>
                    {{ os.locais }}
                  </td>
                  <td>
                    {{ os.data_hora_inicio }}
                  </td>
                  <td>
                    {{ os.data_hora_termino }}
                  </td>
                  <td>
                    {{ os.km_inicial }}
                  </td>
                  <td>
                    {{ os.km_final }}
                  </td>
                  <td>
                    {{ os.id_motorista }}
                  </td>
                  <td>
                    {{ os.status_os }}
                  </td>
                  <td>
                    <button
                      @click="abreModalEditar(index)"
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
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_novo">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">ADICIONAR NOVA OS</h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>            
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
                    v-model="os.id_pessoa"
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
                    v-model="os.id_navio"
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
                  <label for="tiposervico">Serviço:</label>
                  <select
                    name="tiposervico"
                    id="tiposervico"
                    v-model="os.id_tiposervico"
                  >
                    <option disabled value>Selecione uma opção</option>
                    <option
                      v-for="item in tiposervico"
                      :key="item.id"
                      :value="item.id"
                      >{{ item.tipo }}</option
                    >
                  </select>
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
                <div class="form-group col-md-6">
                  <label for="motorista">Motorista:</label>
                  <select
                    name="motorista"
                    id="motorista"
                    v-model="os.id_motorista"
                  >
                    <option disabled value>Selecione um motorista</option>
                    <option
                      v-for="item in pessoa"
                      :key="item.id"
                      :value="item.id"
                      >{{ item.apelido }}</option
                    >
                  </select>
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
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Imprimir
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_eidtar">
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
            <h4 class="modal-title">Editar OS</h4>
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
                    v-model="os.id_pessoa"
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
                    v-model="os.id_navio"
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
                  <label for="tiposervico">Serviço:</label>
                  <select
                    name="tiposervico"
                    id="tiposervico"
                    v-model="os.id_tiposervico"
                  >
                    <option disabled value>Selecione uma opção</option>
                    <option
                      v-for="item in tiposervico"
                      :key="item.id"
                      :value="item.id"
                      >{{ item.tipo }}</option
                    >
                  </select>
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
                    v-model="editar.descricao_servico"
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
                    v-model="editar.locais"
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
                    v-model="editar.data_inicio"
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
                    v-model="editar.hora_inicio"
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
                    v-model="editar.data_termino"
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
                    v-model="editar.hora_termino"
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
                    v-model="editar.km_inicial"
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
                    v-model="editar.km_final"
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
                    v-model="editar.motorista"
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
                    v-model="editar.status"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
            <button type="button" @click="EditaOS" class="btn btn-primary">
              Salvar
            </button>
            <button type="button" @click="abreFormImprimir" class="btn btn-default">
              Imprimir
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
        id:"",
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
        status_os: ""
      },
      editar: {
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
        status_os: ""
      },
      pessoa:{
        id:"",
        apelido:""
      },
      navio:{},
      tiposervico:{},
      editar: {},
      msgs: [],
      lista: [],
      pessoas:[]
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
    this.exibeServicos();
  },
  computed:{
    dt_inicio() {
      let d_inicio = this.os.data_inico.split("/");
      return d_inicio[2] + "-" + d_inicio[1] + "-" + d_inicio[0];
    },
    dt_termino() {
      let d_termino = this.os.data_termino.split("/");
      return d_termino[2] + "-" + d_termino[1] + "-" + d_termino[0];
    },
    ativarBotao() {
      if (
        this.os.apelido > 0 &&
        this.os.tipo_servico > 0 &&
        this.os.length > 10
      ) {
        return this.inativo <= false;
      }
      return this.inativo <= true;
    }
  },
  methods: {
    abreModalAdicionar() {
      this.errors = [];
      $("#modal_novo").modal("show");
    },
    abreModalEditar(index) {
      //this.errors = [];
      $("#modal_editar").modal("show");
      this.editar = this.lista[index];
    },
    abreModalImprimir(index){
      $("#modal_imprimir").modal("show");
    },
    criaOS() {
      axios
        .post("http://localhost:8000/api/oss", {
          id_pessoa: this.os.id_pessoa,
          id_navio: this.os.id_navio,
          id_tipo_servico: this.os.id_tiposervico,
          descricao_servico: this.os.descricao_servico,
          locais: this.os.lcoais,
          data_hora_inicio: dt_inicio + " " + this.os.hora_inicio + ":00",
          data_hora_termino: dt_termino + " " + this.os.hora.termino + ":00",
          km_inicial: this.os.km_inicial,
          km_final: this.os.km_final,
          id_motorista: this.os.id_motorista,
          status_os: 1,
        })
        .then(response => {
          this.lista.push(response.data.os);
          this.msgs.push(response.data.message);
          this.os.id = response.data.os.id;
          axios
          .post('http://localhost:8000/api/oshaspessoas',{
            id_os: this.os.id,
            id_pessoa: this.os.id_pessoa
          });
          this.limpaCampos();
          $("#cliente").trigger("focus");

          // axios.post('http://localhost:8000/api/oshaspessoas',{

          $("#modal_novo").modal("hide");
        })
        .catch(error => {
          // this.errors = [];
          // if (error.response.data.errors.name) {
          //   this.errors.push(error.response.data.errors.name[0]);
          // }

          // if (error.response.data.errors.description) {
          //   this.errors.push(error.response.data.errors.description[0]);
          // }
        });
        // 
    },
    EditaOS(){
      axios
        .patch("http://localhost:8000/api/oss/" + this.editar.id, {
          id_pessoa: this.editar.id_pessoa,
          id_navio: this.editar.id_navio,
          id_tipo_servico: this.editar.id_tiposervico,
          descricao_servico: this.editar.descricao_servico,
          locais: this.editar.lcoais,
          data_hora_inicio: dt_inicio + " " + this.os.hora_inicio + ":00",
          data_hora_termino: dt_termino + " " + this.os.hora.termino + ":00",
          km_inicial: this.editar.km_inicial,
          km_final: this.editar.km_final,
          motorista: this.editar.motorista,
          status_os: 2,
        })
        .then(response => {
          alert("Registro atualizado com sucesso.");
          $("#modal_editar").modal("hide");
        })
        .catch(error => {
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
    // reset() {
    //   (this.os.cliente = ""),
    //   (this.os.navio = ""),
    //   (this.os.tipo_servico = ""),
    //   (this.os.descricao_servico = ""),
    //   (this.os.locais = ""),
    //   (this.os.data_inicio = ""),
    //   (this.os.hora_inicio = ""),
    //   (this.os.data_termino = ""),
    //   (this.os.hora_termino = ""),
    //   (this.os.km_inicial = ""),
    //   (this.os.km_final = ""),
    //   (this.os.motorista = ""),
    //   (this.os.status = "");
    // },
    exibeOss() {
      axios.get("http://localhost:8000/api/oss").then(response => {
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
    exibeServicos(){
      axios.get("http://localhost:8000/api/tiposervico").then(response => {
        this.tiposervico = response.data;
      });
    },
    exibeMotoristas(){
      axios.get("http://localhost:8000/api/motoristas").then(response => {
        this.motoristas = response.data
      })
    },
    excluiOs(index) {
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
