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
                  <th>Data e hora de saída</th>                  
                  <th>Data e hora de término</th>
                  <th>Motorista</th>
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
                  <td v-if = 'os.data_hora_inicio != null'>
                    {{ formataData(os.data_hora_inicio) }}
                  </td>
                  <td v-else-if='os.data_hora_inicio == null'>
                  </td>
                  <td v-if = 'os.data_hora_termino != null'>
                    {{ formataData(os.data_hora_termino) }}
                  </td>
                  <td v-else-if='os.data_hora_termino == null'>
                  </td>
                  <td>
                    {{ os.motorista }}
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
                <li v-for="(error, index) in errors" :key="'erro1-'+index">{{ error }}</li>
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
                <div class="form-group col-md-3">
                  <label for="a_nome_passageiro">Nome do/s passageiro/s:</label>
                  <input
                    ref="a_nome_passageiro"
                    name="a_nome_passageiro"
                    id="a_nome_passageiro"
                    class="form-control"
                  />
                </div>
                <div class="form-group col-md-3">
                  <label for="doc_passageiro">Documento:</label>
                  <input
                    ref="a_doc_passageiro"
                    name="doc_passageiro"
                    id="doc_passageiro"
                    class="form-control"
                  />
                </div>
                <div class="form-group col-md-3">
                  <label for="tel_passageiro">Telefone:</label>
                  <input
                    ref = "a_tel_passageiro"
                    name="tel_passageiro"
                    id="tel_passageiro"
                    class="form-control"
                  />
                </div>
                <button @click="adicionaPassageiro()" type="button" class="add_passageiro" aria-label="Plus_pass">
                  <span aria-hidden="true">&plus;</span>
                </button>   
                <table ref="lista_passageiros" id="lista_passageiros" class="col-md-12">
                    <tr>
                      <th>Nome Passageiro</th>
                      <th>Documento</th>
                      <th>Telefone</th>
                    </tr>
                </table>  
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
                    v-model="os.data_saida"
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
                    v-model="os.hora_saida"
                    v-mask="'##:##'"
                  />
                </div>
                <div class="form-group">
                  <label for="data_chegada">Data de Chegada:</label>
                  <input
                    type="text"
                    name="hora_chegada"
                    id="data_termino"
                    placeholder="Data de término do serviço"
                    class="form-control"
                    v-model="os.data_chegada"
                    v-mask="'##/##/####'"
                  />
                </div>
                <div class="form-group">
                  <label for="hora_termino">Hora de Chegada:</label>
                  <input
                    type="text"
                    name="hora_termino"
                    id="hora_termino"
                    placeholder="Horario de termino do serviçoo"
                    class="form-control"
                    v-model="os.hora_chegada"
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
                  <label for="obs">Observações:</label>
                  <textarea
                    type="text"
                    name="obs"
                    id="obs"
                    placeholder="Observações sobre a viagem"
                    class="form-control"
                    v-model="os.obs"
                  >
                  </textarea>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_editar">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar OS</h4>
            <button
              @click="fecharModal"
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
                <li v-for="(error, index ) in errors" :key="'erro-'+index">{{ error }}</li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group col-md-6">
                  <label for="cliente">Cliente:</label>
                  <select
                    name="cliente"
                    id="cliente"
                    v-model="editar.id_pessoa"
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
                    v-model="editar.id_navio"
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
                    v-model="editar.id_tipo_servico"
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
                <div class="form-group col-md-12">
                  <label for="passageiros">Nome do/s passageiro/s:</label>
                  <textarea
                    name="passageiros"
                    id="passageiros"
                    cols="30"
                    rows="5"
                    class="form-control"
                    placeholder="Nome do/s passageiro/s"
                    v-model="os.passageiros"
                  ></textarea>
                </div>
                <div class="form-group">
                  <label for="Locais">Locais:</label>
                  <textarea v-on:blur="separaLocais()"
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
                    v-model="editar.data_saida"
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
                    v-model="editar.hora_saida"
                    v-mask="'##:##'"
                  />
                </div>
                <div class="form-group">
                  <label for="data_chegada">Data de Término:</label>
                  <input
                    type="text"
                    name="data_chegada"
                    id="data_chegada"
                    placeholder="Data de término do serviço"
                    class="form-control"
                    v-model="editar.data_chegada"
                    v-mask="'##/##/####'"
                  />
                </div>
                <div class="form-group">
                  <label for="hora_chegada">Hora de Término:</label>
                  <input
                    type="text"
                    name="hora_chegada"
                    id="hora_chegada"
                    placeholder="Horario de termino do serviçoo"
                    class="form-control"
                    v-model="editar.hora_chegada"
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
                  <label for="obs">Observações:</label>
                  <textarea
                    type="text"
                    name="obs"
                    id="obs"
                    placeholder="Observações sobre a viagem"
                    class="form-control"
                    v-model="editar.obs"
                  >
                  </textarea>
                </div>
                <div class="form-group col-md-6">
                  <label for="motorista">Motorista:</label>
                  <select
                    name="motorista"
                    id="motorista"
                    v-model="editar.id_motorista"
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
                  <label for="status">Status do Trabalho:</label>
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
            <button type="button" class="btn btn-default">
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
        id_tiposervico: "",
        descricao_servico: "",
        passageiros: [],
        locais: "",
        data_hora_inicio:"",
        data_hora_termino:"",
        data_saida: "00/00/0000",
        hora_saida: "00:00",
        data_chegada: "00/00/0000",
        hora_chegada: "00:00",
        km_inicial: "",
        km_final: "",
        obs:"",
        motorista: "",
        status_os: ""
      },
      editar: {
        id:"",
        cliente: "",
        navio: "",
        id_tipo_servico: "",
        descricao_servico: "",
        passageiros: [],
        locais: "",
        data_hora_inicio: "",
        data_hora_termino: "",
        km_inicial: "",
        km_final: "",
        motorista: "",
        obs:"",
        status_os: ""
      },
      pessoa:{
        id:"",
        apelido:""
      },
      navio:{},
      tiposervico:{},
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
    a_dt_saida() {
      if (this.os.data_saida !== "00/00/0000"){
        let d_saida = this.os.data_saida.split("/");
        let dt_saida = d_saida[2] + "-" + d_saida[1] + "-" + d_saida[0];
        let data_hora_inicio = dt_saida + " " + this.os.hora_saida + ":00";
        return data_hora_inicio;
      }else{
        return null;
      }
    },
    a_dt_chegada() {
      if (this.os.data_chegada != "00/00/0000"){
        let d_chegada = this.os.data_chegada.split("/");
        let data = d_chegada[2] + "-" + d_chegada[1] + "-" + d_chegada[0];
        let data_hora_termino = data + " " + this.os.hora_chegada + ":00"
        return data_hora_termino;
      }else{
        return null;
      }
    },
    e_dt_saida() {
      if (this.editar.data_chegada !== "00/00/0000"){
        let d_saida = this.editar.data_saida.split("/");
        let dt_saida = d_saida[2] + "-" + d_saida[1] + "-" + d_saida[0];
        let data_hora_inicio = dt_saida + " " + this.editar.hora_saida + ":00";
        return data_hora_inicio;
      }else{
        return null;
      }
    },
    e_dt_chegada() {
      if (this.editar.data_chegada !== "00/00/0000"){
        let d_chegada = this.editar.data_chegada.split("/");
        let data = d_chegada[2] + "-" + d_chegada[1] + "-" + d_chegada[0];
        let data_hora_termino = data + " " + this.editar.hora_chegada + ":00"
        return data_hora_termino
      }else{
        return null;
      }
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
    formataData(param){
      var data = new Date(param).toLocaleDateString('pt-br', { weekday:"short", year:"numeric", month:"short", day:"numeric", hour: ('numeric' || '2-digit'), minute: ('numeric' || '2-digit'),})
      return data;
    },
    abreModalAdicionar() {
      this.errors = [];
      $("#modal_novo").modal("show");
    },
    abreModalEditar(index) {
      $("#modal_editar").modal("show");
      this.editar = {
        ...this.editar,
        ...this.lista[index]};
      if(this.editar.data_hora_inicio != null){
        this.editar.data_saida = new Date(this.editar.data_hora_inicio).toLocaleDateString('pt-br', {  year:"numeric", month:"numeric", day:"numeric"});
        let hora = new Date(this.editar.data_hora_inicio).getHours();
        let minuto = new Date(this.editar.data_hora_inicio).getMinutes()
        this.editar.hora_saida = String(hora).padStart(2, "0")+":"+String(minuto).padStart(2, "0")
      }else{
        this.editar.data_saida = "00/00/0000"
        this.editar.hora_saida = "00:00"
      }
      if (this.editar.data_hora_termino != null){
        this.editar.data_chegada = new Date(this.editar.data_hora_termino).toLocaleDateString('pt-br', {  year:"numeric", month:"numeric", day:"numeric"});
        let hora = new Date(this.editar.data_hora_termino).getHours();
        let minuto = new Date(this.editar.data_hora_termino).getMinutes()
        this.editar.hora_chegada = String(hora).padStart(2, "0")+":"+String(minuto).padStart(2, "0")
      }else{
        this.editar.data_chegada = "00/00/0000"
        this.editar.hora_chegada = "00:00"
      }
      this.exibeLocaisOs();
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
          //locais: this.os.lcoais,
          data_hora_inicio: this.a_dt_saida, 
          data_hora_termino: this.a_dt_chegada,
          km_inicial: this.os.km_inicial,
          km_final: this.os.km_final,
          obs: this.os.obs,
          id_motorista: this.os.id_motorista,
          status_os: 1,
        })
        .then(response => {
          this.lista.push(response.data.os);
          this.msgs.push(response.data.message);
          this.os.id = response.data.os.id;
          console.log(this.os.locais);
          if (this.os.locais != ""){
            var id_os = this.os.id
            var arrayLocais = this.os.locais.split("\n");
            this.atualizaLocais(id_os, arrayLocais);
          }
          axios
          .post('http://localhost:8000/api/oshaspessoas',{
            id_os: this.os.id,
            id_pessoa: this.os.id_pessoa
          }).then(response => {

          }).catch(error =>{
            console.log(error);
          });
          this.limpaCampos();
          this.exibeOss();
          $("#cliente").trigger("focus");

          // axios.post('http://localhost:8000/api/oshaspessoas',{

          //$("#modal_novo").modal("hide");
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
          id_tipo_servico: this.editar.id_tipo_servico,
          descricao_servico: this.editar.descricao_servico,
          //locais: this.editar.locais,
          data_hora_inicio: this.e_dt_saida, 
          data_hora_termino: this.e_dt_chegada, 
          km_inicial: this.editar.km_inicial,
          km_final: this.editar.km_final,
          obs: this.editar.obs,
          id_motorista: this.editar.id_motorista,
          status_os: 2,
        })
        .then(response => {
          if (this.editar.locais != ""){
            let id_os = this.editar.id;
            let arrayLocais = this.editar.locais.split("\n");
            this.atualizaLocais(id_os, arrayLocais);
          }
          //console.log(response.data.os);
          this.msgs.push(response.data.message);
          //$("#modal_editar").modal("hide");
          //console.log(response.data.os.id);
          //console.log(response.data.os);
          //console.log(this.lista);
          //let val = response.data.os;
          //console.log(val);
          this.exibeOss();//chama exibir os para atualizar os campos na tabela html.
          //this.$set(this.lista, response.data.os.id - 1, response.data.os)
          //this.lista[response.data.os.id] = response.data.os;
          //this.msgs.push(response.data.message);
          //this.limpaCampos();
          this.fecharModal();
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
    exibeOss() {
      axios.get("http://localhost:8000/api/oss").then(response => {
        this.lista = response.data;
      });
    },
    exibeLocaisOs() {
      axios.get("http://localhost:8000/api/oshaslocais/"+this.editar.id).then(response =>{
        response.data.forEach((local) => {
          console.log(local.nome_local);
          this.editar.locais += local.nome_local + "\n";
        });
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
      let conf = confirm("Deseja mesmo remover esta os?");
      if (conf === true) {
        axios
          .delete("http://localhost:8000/api/oss/" + this.lista[index].id)
          .then(response => {
            this.lista.splice(index, 1);
          })
          .catch(error => {});
      }
    },
    adicionaPassageiro(){
      const passageiro = [];
      passageiro.push(this.$refs.a_nome_passageiro.value);
      passageiro.push(this.$refs.a_doc_passageiro.value);
      passageiro.push(this.$refs.a_tel_passageiro.value);
      console.log(passageiro[0]);
      this.os.passageiros.push(passageiro);
      this.$refs.lista_passageiros.innerHTML += '<tr><td>'+passageiro[0]+'</td><td>'+passageiro[1]+'</td><td>'+passageiro[1]+'</td><td><button @click="removePassageiro()" type="button" class="rem_passageiro" aria-label="rem_pass"><span aria-hidden="true">&minus;</span></button></td></tr>'
      this.$refs.a_nome_passageiro.value = "";
      this.$refs.a_doc_passageiro.value = "";
      this.$refs.a_tel_passageiro.value = "";
      console.log(this.os.passageiros);
    },
    atualizaLocais(id_os,locais){
      console.log(id_os);
      console.log(locais);
     // if (locais.length > 0 ){ 
        for (let i=0; i < locais.length; i++){
          axios
          .post("http://localhost:8000/api/locais", {
            nome_local: locais[i]
          })
          .then(response => {
            console.log(this.editar.id);
            console.log(response.data.local);
            axios
            .post('http://localhost:8000/api/oshaslocais',{
              id_os: this.editar.id,
              id_local: response.data.local
            }).then(response => {
              console.log("os has locais");
            }).catch(error=>{
              console.log("os has not locais");
            });
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
        } 
      // }else{
      //   for (let i=0; i < locais.length; i++){
      //     axios
      //     .post("http://localhost:8000/api/locais", {
      //       nome_local: locais[i]
      //     })
      //     .then(response => {
      //       // console.log(this.editar.id);
      //       // console.log(response.data.local);
      //       axios
      //       .post('http://localhost:8000/api/oshaslocais',{
      //         id_os: this.os.id,
      //         id_local: response.os.local
      //       });
      //     })
      //     .catch(error => {
      //       // this.errors = [];
      //       // if (error.response.data.errors.name) {
      //       //   this.errors.push(error.response.data.errors.name[0]);
      //       // }

      //       // if (error.response.data.errors.description) {
      //       //   this.errors.push(error.response.data.errors.description[0]);
      //       // }
      //     });
      //   }
      //}
    },
    reset() {
      (this.editar.status = "");
      (this.editar.cliente = ""),
      (this.editar.navio = ""),
      (this.editar.tipo_servico = ""),
      (this.editar.descricao_servico = ""),
      (this.editar.locais = ""),
      (this.editar.data_inicio = ""),
      (this.editar.hora_inicio = ""),
      (this.editar.data_termino = ""),
      (this.editar.hora_termino = ""),
      (this.editar.km_inicial = ""),
      (this.editar.km_final = ""),
      (this.editar.obs),
      (this.editar.motorista = ""),
      (this.editar.status = "");
    },
    limpaCampos() {
      const keys = Object.keys(this.os);
      keys.forEach(key => (this.os[key] = ""));
      this.os.apelido = 0;
      this.os.nome = 0;
      this.os.tipo = 0;
      this.esconde_alerta();
      this.errors.clear();
      $(".form-control.invalido").removeClass("invalido");
    },
    esconde_alerta() {
      setTimeout(() => {
        $(".alert").alert("close");
      }, 7000);
    },
    fecharModal() {
      this.reset();
      this.limpaCampos();
      $('#modal_editar').modal("hide");
      $("#modal_novo").modal("hide");
    }
  },
};
</script>
