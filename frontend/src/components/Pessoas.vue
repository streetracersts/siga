<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1 class="titulo-secao">Pessoas</h1>
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
                  <th>Cod.</th>
                  <th>Nome</th>
                  <th>RG</th>
                  <th>CPF/CNPJ</th>
                  <th>Telefone</th>
                  <th>Endereço</th>
                  <th>Número</th>
                  <th>Comp.</th>
                  <th>Bairro</th>
                  <th>Cidade</th>
                  <th>UF</th>
                  <th>Ações</th>
                  <!--th>Nome do pai</th>
                  <th>Nome da mãe</th-->
                </tr>
                <tr v-for="(pessoa, index) in lista" :key="pessoa.id">
                  <td>{{ pessoa.id }}</td>
                  <td>{{ pessoa.apelido }}</td>
                  <td>{{ pessoa.rg }}</td>
                  <td>{{ pessoa.cpf }}</td>
                  <!--td>{{ pessoa.genero }}</td>
                  <td>{{ pessoa.numero_ctps }}</td>
                  <td>{{ pessoa.serie_ctps }}</td>
                  <td>{{ pessoa.numero_pis }}</td>
                  <td>{{ pessoa.salario }}</td-->
                  <td>{{ pessoa.telefone1 }}</td>
                  <td>{{ pessoa.endereco }}</td>
                  <td>{{ pessoa.numero }}</td>
                  <td>{{ pessoa.complemento }}</td>
                  <td>{{ pessoa.bairro }}</td>
                  <td>{{ pessoa.cidade }}</td>
                  <td>{{ pessoa.uf }}</td>
                  <!--td>{{ pessoa.nome_pai }}</td>
                  <td>{{ pessoa.nome_mae }}</td-->
                  <td>
                    <button
                      @click="abreEditarModal(index)"
                      class="btn btn-success btn-xs"
                    >
                      Editar
                    </button>
                    <!--button
                      @click="excluiPessoa(index)"
                      class="btn btn-danger btn-xs"
                    >
                      Excluir
                    </button-->
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
            <h4 class="modal-title">ADICIONAR PESSOA</h4>
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
            <div
              class="alert alert-danger alert-dismissible fade show"
              role="alert"
              v-if="msgs.length > 0"
            >
              <p v-for="msg in msgs" v-bind:key="msg">{{ msg }}</p>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <select class="form-select" aria-label = "Selecionar tipo de cliente"
                    name="tipopessoa"
                    id="tipopessoa"
                    v-model="tipopessoa.id_tipo_pessoa"
                  >
                    <option disabled value>Selecione uma opção</option>
                    <option
                      v-for="item in tipopessoa"
                      :key="item.id"
                      :value="item.id"
                      >{{ item.tipo }}</option
                    >
                  </select>
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa > 0" class="col-md-6">
                <div class="form-group">
                  <label for="apelido">Apelido ou nome fantasia: *</label>
                  <input
                    type="text"
                    name="apelido"
                    id="apelido"
                    class="form-control"
                    v-model="pessoa.apelido"
                    v-validate="'required'"
                  />
                  <span>{{ errors.first("apelido") }}</span>
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa > 0" class="col-md-6">
                <div class="form-group">
                  <label for="nome_razao">Nome completo ou Razão Social:</label>
                  <input
                    type="text"
                    name="nome_razao"
                    id="nome_razao"
                    placeholder
                    class="form-control"
                    v-model="pessoa.nome_razao"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa === 1" class="col-md-6">
                <div class="form-group">
                  <label for="cnpj">CNPJ:</label>
                  <input
                    type="text"
                    name="cnpj"
                    id="cnpj"
                    placeholder="__.___.___-_____/__"
                    class="form-control"
                    v-model="pessoa.cnpj"
                    v-mask="'##.###.###/####-##'"
                  />
                  <span>{{ errors.field }}</span>
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa >= 2" class="col-md-6">
                <div class="form-group">
                  <label for="cpf">CPF:</label>
                  <input
                    type="text"
                    name="cpf"
                    id="cpf"
                    placeholder="___.___.___-__"
                    class="form-control"
                    v-model="pessoa.cpf"
                    v-mask="'###.###.###-##'"
                  />
                  <span>{{ errors.field }}</span>
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa > 0" class="col-md-2">
                <div class="form-group">
                  <label for="cep">CEP:</label>
                  <input
                    type="text"
                    name="cep"
                    id="cep"
                    placeholder="_____-___"
                    class="form-control"
                    v-model="pessoa.cep"
                    @blur="buscaCep"
                    v-mask="'#####-###'"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa > 0" class="col-md-6">
                <div class="form-group">
                  <label for="endereco">Endereço:</label>
                  <input
                    type="text"
                    name="endereco"
                    id="endereco"
                    placeholder
                    class="form-control"
                    v-model="pessoa.endereco"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa > 0" class="col-md-2">
                <div class="form-group">
                  <label for="numero">Número:</label>
                  <input
                    type="text"
                    name="numero"
                    id="numero"
                    placeholder
                    class="form-control"
                    v-model="pessoa.numero"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa > 0" class="col-md-2">
                <div class="form-group">
                  <label for="complemento">Complemento:</label>
                  <input
                    type="text"
                    name="complemento"
                    id="complemento"
                    placeholder
                    class="form-control"
                    v-model="pessoa.complemento"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa > 0" class="col-md-3">
                <div class="form-group">
                  <label for="bairro">Bairro:</label>
                  <input
                    type="text"
                    name="bairro"
                    id="bairro"
                    placeholder
                    class="form-control"
                    v-model="pessoa.bairro"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa > 0" class="col-md-4">
                <div class="form-group">
                  <label for="cidade">Cidade:</label>
                  <input
                    type="text"
                    name="cidade"
                    id="cidade"
                    placeholder
                    class="form-control"
                    v-model="pessoa.cidade"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa > 0" class="col-md-2">
                <div class="form-group">
                  <label for="uf">UF:</label>
                  <input
                    type="text"
                    name="uf"
                    id="uf"
                    placeholder=""
                    class="form-control"
                    v-model="pessoa.uf"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa > 0" class="col-md-3">
                <div class="form-group">
                  <label for="pais">País:</label>
                  <input
                    type="text"
                    name="pais"
                    id="pais"
                    placeholder=""
                    class="form-control"
                    v-model="pessoa.pais"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa > 0" class="col-md-3">
                <div class="form-group">
                  <label for="telefone">Telefone: *</label>
                  <input
                    type="text"
                    name="telefone"
                    id="telefone"
                    placeholder="()____-____"
                    class="form-control"
                    v-model="pessoa.telefone1"
                    v-validate="'required'"
                    v-mask="['(##)####-####', '(##)#####-####']"
                  />
                  <span>{{ errors.first("telefone") }}</span>
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa > 0" class="col-md-3">
                <div class="form-group">
                  <label for="telefone2">Telefone 2:</label>
                  <input
                    type="text"
                    name="telefone2"
                    id="telefone2"
                    placeholder="()____-____"
                    class="form-control"
                    v-model="pessoa.telefone2"
                    v-mask="['(##)####-####', '(##)#####-####']"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa > 0" class="col-md-6">
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input
                    type="text"
                    name="email"
                    id="email"
                    placeholder="email@domínio"
                    class="form-control"
                    v-model="pessoa.email"
                    v-validate="'email'"
                  />
                  <span>{{ errors.first("email") }}</span>
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa >= 2" class="col-md-6">
                <div class="form-group">
                  <label for="rg">Identidade:</label>
                  <input
                    type="text"
                    name="rg"
                    id="rg"
                    class="form-control"
                    v-model="pessoa.rg"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa >= 2" class="col-md-6">
                <div class="form-group">
                  <label for="o_emissor">Orgão emissor:</label>
                  <input
                    type="text"
                    name="o_emissor"
                    id="o_emissor"
                    class="form-control"
                    v-model="pessoa.o_emissor"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa >= 2" class="col-md-6">
                <div class="form-group">
                  <label for="data_emissao">Data da emissão:</label>
                  <input
                    type="text"
                    name="data_emissao"
                    id="data_emissao"
                    placeholder="__/__/____"
                    class="form-control"
                    v-model="pessoa.data_emissao"
                    v-mask="'##/##/####'"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa >= 2" class="col-md-6">
                <div class="form-group">
                  <label for="rg">Identidade:</label>
                  <input
                    type="text"
                    name="rg"
                    id="rg"
                    class="form-control"
                    v-model="pessoa.rg"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa >= 2" calss="col-md-2">
                <div class="form-group">
                  <label for="o_emissor">Orgão emissor:</label>
                  <input
                    type="text"
                    name="o_emissor"
                    id="o_emissor"
                    class="form-control"
                    v-model="pessoa.o_emissor"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa >= 2" ckass="col-md-2">
                <div class="form-group">
                  <label for="data_emissao">Data da emissão:</label>
                  <input
                    type="text"
                    name="data_emissao"
                    id="data_emissao"
                    placeholder="__/__/____"
                    class="form-control"
                    v-model="pessoa.data_emissao"
                    v-mask="'##/##/####'"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa == 3" class="col-md-4">
                <div class="form-group">
                  <label for="cnh">CNH:</label>
                  <input
                    type="text"
                    name="cnh"
                    id="cnh"
                    class="form-control"
                    v-model="pessoa.cnh"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa == 3" class="col-md-1">
                <div class="form-group">
                  <label for="cnh_categoria">Categoria CNH:</label>
                  <input
                    type="text"
                    name="cnh_categoria"
                    id="cnh_categoria"
                    class="form-control"
                    v-model="pessoa.cnh_categoria"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa == 3" class="col-md-2">
                <div class="form-group">
                  <label for="genero">Gênero:</label>
                  <select name="genero" id="genero" v-model="tipopessoa.genero">
                    <option disabled value>Selecione uma opção</option>
                    <option value="0">Feminino</option>
                    <option value="1">Masculino</option>
                  </select>
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa >= 2" class="col-md-3">
                <div class="form-group">
                  <label for="data_nascimento">Data de Nascimento:</label>
                  <input
                    type="text"
                    name="data_nascimento"
                    id="data_nascimento"
                    placeholder="__/__/___"
                    class="form-control"
                    v-model="pessoa.data_nascimento"
                    v-mask="'##/##/####'"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa == 3" class="col-md-2">
                <div class="form-group">
                  <label for="numeroCtps">Número CTPS:</label>
                  <input
                    type="text"
                    name="numeroCtps"
                    id="numeroCtps"
                    placeholder
                    class="form-control"
                    v-model="pessoa.numero_ctps"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa == 3" class="col-md-2">
                <div class="form-group">
                  <label for="serieCtps">Série CTPS:</label>
                  <input
                    type="text"
                    name="serieCtps"
                    id="serieCtps"
                    placeholder
                    class="form-control"
                    v-model="pessoa.serie_ctps"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa == 3" class="col-md-3">
                <div class="form-group">
                  <label for="pis">Número Pis:</label>
                  <input
                    type="text"
                    name="pis"
                    id="pis"
                    placeholder
                    class="form-control"
                    v-model="pessoa.pis"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa == 3" class="col-md-3">
                <div class="form-group">
                  <label for="salario">Salário:</label>
                  <input
                    type="text"
                    name="salario"
                    id="salario"
                    placeholder="0,00"
                    class="form-control"
                    v-model="pessoa.salario"
                    v-mask="'#,##'"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa == 3" class="col-md-3">
                <div class="form-group">
                  <label for="nomePai">Nome do pai:</label>
                  <input
                    type="text"
                    name="nomePai"
                    id="nomePai"
                    placeholder
                    class="form-control"
                    v-model="pessoa.nome_pai"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa == 3" class="col-md-3">
                <div class="form-group">
                  <label for="nomeMae">Nome do mãe:</label>
                  <input
                    type="text"
                    name="nomeMae"
                    id="nomeMae"
                    placeholder
                    class="form-control"
                    v-model="pessoa.nome_mae"
                  />
                </div>
              </div>
              <div v-if="tipopessoa.id_tipo_pessoa > 0" class="col-md-6">
                <div class="form-group">
                  <label for="observacoes">Observações Gerais:</label>
                  <textarea
                    name="observacoes"
                    id="observacoes"
                    cols="30"
                    rows="5"
                    class="form-control"
                    placeholder="Observações Gerais"
                    v-model="pessoa.observacoes"
                  ></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              @click="limpaCampos"
              @keydown.esc="limpaCampos"
              class="btn btn-default"
              data-dismiss="modal"
            >
              Cancelar
            </button>
            <button
              type="button"
              @click="adicionaPessoa"
              @keyup.alt.s="adicionaPessoa"
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
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_editar">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">EDITAR PESSOA</h4>
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
            <div
              class="alert alert-danger alert-dismissible fade show"
              role="alert"
              v-if="msgs.length > 0"
            >
              <p v-for="msg in msgs" v-bind:key="msg">{{ msg }}</p>
            </div>
            <div class="row">
              <!-- <div class="col-md-12">
                <div class="form-group">
                  <select class="form-select" aria-label = "Selecionar tipo de cliente"
                    name="tipopessoa"
                    id="tipopessoa"
                    v-model="editarpessoa.id_tipo_pessoa"
                  >
                    <option disabled value>Selecione uma opção</option>
                    <option
                      v-for="item in tipopessoa"
                      :key="item.id"
                      :value="item.id"
                      >{{ item.tipo }}</option
                    >
                  </select>
                </div>
              </div> -->
              <div v-if="editarpessoa.id_tipo_pessoa > 0" class="col-md-6">
                <div class="form-group">
                  <label for="apelido">Apelido ou nome fantasia: *</label>
                  <input
                    type="text"
                    name="apelido"
                    id="apelido"
                    class="form-control"
                    v-model="editarpessoa.apelido"
                    v-validate="'required'"
                  />
                  <span>{{ errors.first("apelido") }}</span>
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa > 0" class="col-md-6">
                <div class="form-group">
                  <label for="nome_razao">Nome completo ou Razão Social:</label>
                  <input
                    type="text"
                    name="nome_razao"
                    id="nome_razao"
                    placeholder
                    class="form-control"
                    v-model="editarpessoa.nome_razao"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa === 1" class="col-md-6">
                <div class="form-group">
                  <label for="cnpj">CNPJ:</label>
                  <input
                    type="text"
                    name="cnpj"
                    id="cnpj"
                    placeholder="__.___.___-_____/__"
                    class="form-control"
                    v-model="editarpessoa.cnpj"
                    v-mask="'##.###.###/####-##'"
                  />
                  <span>{{ errors.field }}</span>
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa >= 2" class="col-md-6">
                <div class="form-group">
                  <label for="cpf">CPF:</label>
                  <input
                    type="text"
                    name="cpf"
                    id="cpf"
                    placeholder="___.___.___-__"
                    class="form-control"
                    v-model="editarpessoa.cpf"
                    v-mask="'###.###.###-##'"
                  />
                  <span>{{ errors.field }}</span>
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa > 0" class="col-md-2">
                <div class="form-group">
                  <label for="cep">CEP:</label>
                  <input
                    type="text"
                    name="cep"
                    id="cep"
                    placeholder="_____-___"
                    class="form-control"
                    v-model="editarpessoa.cep"
                    @blur="buscaCep"
                    v-mask="'#####-###'"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa > 0" class="col-md-6">
                <div class="form-group">
                  <label for="endereco">Endereço:</label>
                  <input
                    type="text"
                    name="endereco"
                    id="endereco"
                    placeholder
                    class="form-control"
                    v-model="editarpessoa.endereco"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa > 0" class="col-md-2">
                <div class="form-group">
                  <label for="numero">Número:</label>
                  <input
                    type="text"
                    name="numero"
                    id="numero"
                    placeholder
                    class="form-control"
                    v-model="editarpessoa.numero"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa > 0" class="col-md-2">
                <div class="form-group">
                  <label for="complemento">Complemento:</label>
                  <input
                    type="text"
                    name="complemento"
                    id="complemento"
                    placeholder
                    class="form-control"
                    v-model="editarpessoa.complemento"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa > 0" class="col-md-3">
                <div class="form-group">
                  <label for="bairro">Bairro:</label>
                  <input
                    type="text"
                    name="bairro"
                    id="bairro"
                    placeholder
                    class="form-control"
                    v-model="editarpessoa.bairro"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa > 0" class="col-md-4">
                <div class="form-group">
                  <label for="cidade">Cidade:</label>
                  <input
                    type="text"
                    name="cidade"
                    id="cidade"
                    placeholder
                    class="form-control"
                    v-model="editarpessoa.cidade"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa > 0" class="col-md-2">
                <div class="form-group">
                  <label for="uf">UF:</label>
                  <input
                    type="text"
                    name="uf"
                    id="uf"
                    placeholder=""
                    class="form-control"
                    v-model="editarpessoa.uf"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa > 0" class="col-md-3">
                <div class="form-group">
                  <label for="pais">País:</label>
                  <input
                    type="text"
                    name="pais"
                    id="pais"
                    placeholder=""
                    class="form-control"
                    v-model="editarpessoa.pais"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa > 0" class="col-md-3">
                <div class="form-group">
                  <label for="telefone">Telefone: *</label>
                  <input
                    type="text"
                    name="telefone"
                    id="telefone"
                    placeholder="()____-____"
                    class="form-control"
                    v-model="editarpessoa.telefone1"
                    v-validate="'required'"
                    v-mask="['(##)####-####', '(##)#####-####']"
                  />
                  <span>{{ errors.first("telefone") }}</span>
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa > 0" class="col-md-3">
                <div class="form-group">
                  <label for="telefone2">Telefone 2:</label>
                  <input
                    type="text"
                    name="telefone2"
                    id="telefone2"
                    placeholder="()____-____"
                    class="form-control"
                    v-model="editarpessoa.telefone2"
                    v-mask="['(##)####-####', '(##)#####-####']"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa > 0" class="col-md-6">
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input
                    type="text"
                    name="email"
                    id="email"
                    placeholder="email@domínio"
                    class="form-control"
                    v-model="editarpessoa.email"
                    v-validate="'email'"
                  />
                  <span>{{ errors.first("email") }}</span>
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa >= 2" class="col-md-6">
                <div class="form-group">
                  <label for="rg">Identidade:</label>
                  <input
                    type="text"
                    name="rg"
                    id="rg"
                    class="form-control"
                    v-model="editarpessoa.rg"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa >= 2" class="col-md-6">
                <div class="form-group">
                  <label for="o_emissor">Orgão emissor:</label>
                  <input
                    type="text"
                    name="o_emissor"
                    id="o_emissor"
                    class="form-control"
                    v-model="editarpessoa.o_emissor"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa >= 2" class="col-md-6">
                <div class="form-group">
                  <label for="data_emissao">Data da emissão:</label>
                  <input
                    type="text"
                    name="data_emissao"
                    id="data_emissao"
                    placeholder="__/__/____"
                    class="form-control"
                    v-model="editarpessoa.data_emissao"
                    v-mask="'##/##/####'"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa >= 2" class="col-md-6">
                <div class="form-group">
                  <label for="rg">Identidade:</label>
                  <input
                    type="text"
                    name="rg"
                    id="rg"
                    class="form-control"
                    v-model="editarpessoa.rg"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa >= 2" calss="col-md-2">
                <div class="form-group">
                  <label for="o_emissor">Orgão emissor:</label>
                  <input
                    type="text"
                    name="o_emissor"
                    id="o_emissor"
                    class="form-control"
                    v-model="editarpessoa.o_emissor"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa >= 2" ckass="col-md-2">
                <div class="form-group">
                  <label for="data_emissao">Data da emissão:</label>
                  <input
                    type="text"
                    name="data_emissao"
                    id="data_emissao"
                    placeholder="__/__/____"
                    class="form-control"
                    v-model="editarpessoa.data_emissao"
                    v-mask="'##/##/####'"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa == 3" class="col-md-4">
                <div class="form-group">
                  <label for="cnh">CNH:</label>
                  <input
                    type="text"
                    name="cnh"
                    id="cnh"
                    class="form-control"
                    v-model="editarpessoa.cnh"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa == 3" class="col-md-1">
                <div class="form-group">
                  <label for="cnh_categoria">Categoria CNH:</label>
                  <input
                    type="text"
                    name="cnh_categoria"
                    id="cnh_categoria"
                    class="form-control"
                    v-model="editarpessoa.cnh_categoria"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa == 3" class="col-md-2">
                <div class="form-group">
                  <label for="genero">Gênero:</label>
                  <select name="genero" id="genero" v-model="tipopessoa.genero">
                    <option disabled value>Selecione uma opção</option>
                    <option value="0">Feminino</option>
                    <option value="1">Masculino</option>
                  </select>
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa >= 2" class="col-md-3">
                <div class="form-group">
                  <label for="data_nascimento">Data de Nascimento:</label>
                  <input
                    type="text"
                    name="data_nascimento"
                    id="data_nascimento"
                    placeholder="__/__/___"
                    class="form-control"
                    v-model="editarpessoa.data_nascimento"
                    v-mask="'##/##/####'"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa == 3" class="col-md-2">
                <div class="form-group">
                  <label for="numeroCtps">Número CTPS:</label>
                  <input
                    type="text"
                    name="numeroCtps"
                    id="numeroCtps"
                    placeholder
                    class="form-control"
                    v-model="editarpessoa.numero_ctps"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa == 3" class="col-md-2">
                <div class="form-group">
                  <label for="serieCtps">Série CTPS:</label>
                  <input
                    type="text"
                    name="serieCtps"
                    id="serieCtps"
                    placeholder
                    class="form-control"
                    v-model="editarpessoa.serie_ctps"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa == 3" class="col-md-3">
                <div class="form-group">
                  <label for="pis">Número Pis:</label>
                  <input
                    type="text"
                    name="pis"
                    id="pis"
                    placeholder
                    class="form-control"
                    v-model="editarpessoa.pis"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa == 3" class="col-md-3">
                <div class="form-group">
                  <label for="salario">Salário:</label>
                  <input
                    type="text"
                    name="salario"
                    id="salario"
                    placeholder="0,00"
                    class="form-control"
                    v-model="editarpessoa.salario"
                    v-mask="'#,##'"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa == 3" class="col-md-3">
                <div class="form-group">
                  <label for="nomePai">Nome do pai:</label>
                  <input
                    type="text"
                    name="nomePai"
                    id="nomePai"
                    placeholder
                    class="form-control"
                    v-model="editarpessoa.nome_pai"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa == 3" class="col-md-3">
                <div class="form-group">
                  <label for="nomeMae">Nome do mãe:</label>
                  <input
                    type="text"
                    name="nomeMae"
                    id="nomeMae"
                    placeholder
                    class="form-control"
                    v-model="editarpessoa.nome_mae"
                  />
                </div>
              </div>
              <div v-if="editarpessoa.id_tipo_pessoa > 0" class="col-md-6">
                <div class="form-group">
                  <label for="observacoes">Observações Gerais:</label>
                  <textarea
                    name="observacoes"
                    id="observacoes"
                    cols="30"
                    rows="5"
                    class="form-control"
                    placeholder="Observações Gerais"
                    v-model="editarpessoa.observacoes"
                  ></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              @click="limpaCampos"
              @keydown.esc="limpaCampos"
              class="btn btn-default"
              data-dismiss="modal"
            >
              Cancelar
            </button>
            <button
              type="button"
              @click="atualizaPessoa"
              @keyup.alt.s="atualizaPessoa"
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
  //props: ["pessoas", "tipospessoa"],
  data() {
    return {
      inativo: true,
      pessoa: {
        id: "",
        apelido: "",
        nome_razao: "",
        id_tipo_pessoa: "",
        rg: "",
        o_emissor: "",
        data_emissao: "",
        cnh: "",
        cnh_categoria: "",
        cpf: "",
        genero: "",
        data_nascimento: "",
        numero_ctps: "",
        serie_ctps: "",
        pis: "",
        im: "",
        ie: "",
        salario: "",
        numero_pis: "",
        cep: "",
        endereco: "",
        numero: "",
        complemento: "",
        bairro: "",
        cidade: "",
        uf: "",
        nome_pai: "",
        nome_mae: "",
        telefone1: "",
        telefone2: "",
        status: "",
        observacoes: ""
      },
      editarpessoa: {
        id: "",
        apelido: "",
        nome_razao: "",
        id_tipo_pessoa: "",
        rg: "",
        o_emissor: "",
        data_emissao: "",
        cnh: "",
        cnh_categoria: "",
        cpf: "",
        genero: "",
        data_nascimento: "",
        numero_ctps: "",
        serie_ctps: "",
        pis: "",
        im: "",
        ie: "",
        salario: "",
        numero_pis: "",
        cep: "",
        endereco: "",
        numero: "",
        complemento: "",
        bairro: "",
        cidade: "",
        uf: "",
        nome_pai: "",
        nome_mae: "",
        telefone1: "",
        telefone2: "",
        status: "",
        observacoes: ""
      },
      tipopessoa: {},
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
    this.exibePessoas();
    this.exibeTipo_pessoa();
  },
  computed: {
    dt_nascimento() {
      let nascimento = this.pessoa.data_nascimento.split("/");
      return nascimento[2] + "-" + nascimento[1] + "-" + nascimento[0];
    },
    dt_emissao() {
      let emissao = this.pessoa.data_emissao.split("/");
      return emissao[2] + "-" + emissao[1] + "-" + emissao[0];
    },
    ativarBotao() {
      if (
        this.pessoa.apelido.length > 0 &&
        this.pessoa.telefone1.length >= 13
      ) {
        return this.inativo <= false;
      }
      if (
        this.editarpessoa.apelido.length > 0 &&
        this.editarpessoa.telefone1.length >= 13
      ) {
        return this.inativo <= false;
      }
      return this.inativo <= true;
    }
  },
  methods: {
    abreFormAdicionar() {
      $("#modal_novo").modal("show");
      $("#modal_novo").on("shown.bs.modal", function() {
        $("#tipopessoa").trigger("focus");
      });
    },
    adicionaPessoa() {
      axios
        .post("http://localhost:8000/api/pessoa", {
          id_tipo_pessoa: this.tipopessoa.id_tipo_pessoa,
          apelido: this.pessoa.apelido,
          nome_razao: this.pessoa.nome_razao,
          rg: this.pessoa.rg,
          o_emissor: this.pessoa.o_emissor,
          data_emissao: this.pessoa.dt_emissao,
          cnh: this.pessoa.cnh,
          cnh_categoria: this.pessoa.cnh_categoria,
          cpf: this.pessoa.cpf,
          genero: this.pessoa.genero,
          data_nascimento: this.pessoa.dt_nascimento,
          n_ctps: this.pessoa.numero_ctps,
          serie_ctps: this.pessoa.serie_ctps,
          pis: this.pessoa.pis,
          im: this.pessoa.im,
          ie: this.pessoa.ie,
          salario: this.pessoa.salario,
          cep: this.pessoa.cep,
          endereco: this.pessoa.endereco,
          numero: this.pessoa.numero,
          complemento: this.pessoa.complemento,
          bairro: this.pessoa.bairro,
          cidade: this.pessoa.cidade,
          uf: this.pessoa.uf,
          pais: this.pessoa.pais,
          nome_pai: this.pessoa.nome_pai,
          nome_mae: this.pessoa.nome_mae,
          telefone1: this.pessoa.telefone1,
          telefone2: this.pessoa.telefone2,
          email: this.pessoa.email,
          obs: this.pessoa.observacoes,
          status: 1
        })
        .then(response => {
          this.msgs.push(response.data.apelido + " cadastrado(a) com sucesso!");
          this.lista.push(response.data);
          this.limpaCampos();
          $("#tipo").trigger("focus");
        })
        .catch(error => {
          this.msgs.push(error.response.data.errors);
          this.esconde_alerta();
        });
    },
    excluiPessoa(index) {
      let conf = confirm("Deseja mesmo remover" + this.lista[index].apelido);
      if (conf === true) {
        axios
          .delete("http://localhost:8000/api/pessoa/" + this.lista[index].id)
          .then(response => {
            this.lista.splice(index, 1);
          })
          .catch(error => {});
      }
    },
    exibePessoas() {
      axios.get("http://localhost:8000/api/pessoa").then(response => {
        this.lista = response.data;
      });
    },
    exibeTipo_pessoa() {
      axios.get("http://localhost:8000/api/tipopessoa").then(response => {
        this.tipopessoa = response.data;
      });
    },
    buscaCep() {
      var cep = this.pessoa.cep;
      if (cep.length == 9) {
        $.get("https://ws.apicep.com/cep.json", {
          code: cep
        }).then(response => {
          var endereco = response.address.split("-");
          this.pessoa.endereco = endereco[0];
          this.pessoa.bairro = response.district;
          this.pessoa.cidade = response.city;
          this.pessoa.uf = response.state;
        });
      }
    },
    abreEditarModal(index) {
      //this.errors = [];
      $("#modal_editar").modal("show");
      this.editarpessoa = this.lista[index];
    },
    atualizaPessoa() {
      console.log(this.editarpessoa.id);
      axios
        .patch("http://localhost:8000/api/pessoa/" + this.editarpessoa.id, {
          id: this.editarpessoa.id,
          id_tipo_pessoa: this.editarpessoa.id_tipo_pessoa,
          apelido: this.editarpessoa.apelido,
          nome_razao: this.editarpessoa.nome_razao,
          rg: this.editarpessoa.rg,
          o_emissor: this.editarpessoa.o_emissor,
          data_emissao: this.editarpessoa.dt_emissao,
          cnh: this.editarpessoa.cnh,
          cnh_categoria: this.editarpessoa.cnh_categoria,
          cpf: this.editarpessoa.cpf,
          genero: this.editarpessoa.genero,
          data_nascimento: this.editarpessoa.dt_nascimento,
          n_ctps: this.editarpessoa.numero_ctps,
          serie_ctps: this.editarpessoa.serie_ctps,
          pis: this.editarpessoa.pis,
          im: this.editarpessoa.im,
          ie: this.editarpessoa.ie,
          salario: this.editarpessoa.salario,
          cep: this.editarpessoa.cep,
          endereco: this.editarpessoa.endereco,
          numero: this.editarpessoa.numero,
          complemento: this.editarpessoa.complemento,
          bairro: this.editarpessoa.bairro,
          cidade: this.editarpessoa.cidade,
          uf: this.editarpessoa.uf,
          pais: this.editarpessoa.pais,
          nome_pai: this.editarpessoa.nome_pai,
          nome_mae: this.editarpessoa.nome_mae,
          telefone1: this.editarpessoa.telefone1,
          telefone2: this.editarpessoa.telefone2,
          email: this.editarpessoa.email,
          obs: this.editarpessoa.observacoes,
          status: 1
        })
        .then(response => {
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
    limpaCampos() {
      const keys = Object.keys(this.pessoa);
      keys.forEach(key => (this.pessoa[key] = ""));
      this.pessoa.id_tipo_pessoa = 0;
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
      this.limpaCampos();
      $("#modal_novo").modal("hide");
    }
  }
};
</script>
<style>
.btn-primary {
  float: right;
}

.form-control.invalido {
  border-color: red;
}

.form-group span {
  color: red;
}
</style>
