<?php
/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Wave Integrador API",
 *         description="API para eventos de Nota Fiscal.",
 *     ),
 *     @OA\Server(url=API_URL),
 * )
 * 
 * @OA\Tag(
 *     name="assinatura-de-nota-fiscal",
 *     description="Ações referentes ao evento de assinatura de nota fiscal"
 * )
 * 
 * @OA\Tag(
 *     name="validacao",
 *     description="Ações referentes ao evento de validação de nota fiscal"
 * )
 * 
 * @OA\Tag(
 *     name="autorizacao",
 *     description="Ações referentes ao evento de autorização de nota fiscal"
 * )
 * 
 * @OA\Tag(
 *     name="cancelamento",
 *     description="Ações referentes ao evento de cancelamento de nota fiscal"
 * )
 * 
 * @OA\Tag(
 *     name="carta-de-correcao",
 *     description="Ações referentes ao evento de carta de correção de nota fiscal"
 * )
 * 
 * @OA\Tag(
 *     name="manifestacao",
 *     description="Ações referentes ao evento de manifestação de nota fiscal"
 * )
 * 
 * @OA\Tag(
 *     name="inutilizacao",
 *     description="Ações referentes ao evento de inutilização de nota fiscal"
 * )
 * 
 * @OA\Tag(
 *     name="contatos-receberao-nfe",
 *     description="Ações referentes ao contato que receberá a nfe por e-mail"
 * )
 * 
 * @OA\Tag(
 *     name="cliente",
 *     description="Ações referentes ao cliente"
 * )
 * 
 * @OA\Tag(
 *     name="danfe-autorizacao",
 *     description="Ações referentes a danfe do evento de autorização"
 * )
 * 
 * @OA\Tag(
 *     name="danfe-carta-de-correcao",
 *     description="Ações referentes a danfe do evento de carta de correção"
 * )
 * 
 * @OA\Tag(
 *     name="pessoa",
 *     description="Ações referentes a pessoa"
 * )
 * 
 * @OA\Tag(
 *     name="retorno-assinatura-xml-local",
 *     description="Ações referentes ao retorno de assinatura de xml local"
 * )
 * 
 * @OA\Tag(
 *     name="retorno-callback",
 *     description="Ações referentes ao retorno de callback"
 * )
 * 
 * @OA\Tag(
 *     name="certificados",
 *     description="Ações referentes aos certificados"
 * )
 * 
 * @OA\Tag(
 *     name="tipos-de-certificado",
 *     description="Ações referentes aos tipos de certificado"
 * )
 * 
 * @OA\Tag(
 *     name="servico-de-email",
 *     description="Ações referentes aos serviços de e-mail"
 * )
 * 
 * @OA\Tag(
 *     name="user",
 *     description="Ações referentes aos usuários"
 * )
 * 
 * @OA\Parameter(
 *     parameter="evento_id",
 *     name="evento_id",
 *     description="Id do evento",
 *     @OA\Schema(
 *         type="integer",
 *     ),
 *     in="path",
 *     required=true
 * )
 * 
 * @OA\Parameter(
 *     parameter="cliente_id",
 *     name="cliente_id",
 *     description="Id do cliente",
 *     @OA\Schema(
 *         type="integer",
 *     ),
 *     in="path",
 *     required=true
 * )
 * 
 * @OA\Parameter(
 *     parameter="contato_id",
 *     name="contato_id",
 *     description="Id do contato",
 *     @OA\Schema(
 *         type="integer",
 *     ),
 *     in="path",
 *     required=true
 * )
 * 
 * @OA\Parameter(
 *     parameter="danfe_id",
 *     name="danfe_id",
 *     description="Id da danfe",
 *     @OA\Schema(
 *         type="integer",
 *     ),
 *     in="path",
 *     required=true
 * )
 * 
 * @OA\Parameter(
 *     parameter="pessoa_id",
 *     name="pessoa_id",
 *     description="Id da pessoa",
 *     @OA\Schema(
 *         type="integer",
 *     ),
 *     in="path",
 *     required=true
 * )
 * 
 * @OA\Parameter(
 *     parameter="fila_id",
 *     name="fila_id",
 *     description="Id da fila",
 *     @OA\Schema(
 *         type="integer",
 *     ),
 *     in="path",
 *     required=true
 * )
 * 
 * @OA\Parameter(
 *     parameter="certificado_id",
 *     name="certificado_id",
 *     description="Id da certificado",
 *     @OA\Schema(
 *         type="integer",
 *     ),
 *     in="path",
 *     required=true
 * )
 * 
 * @OA\Parameter(
 *     parameter="servico_de_email_id",
 *     name="servico_de_email_id",
 *     description="Id do serviço de e-mail",
 *     @OA\Schema(
 *         type="integer",
 *     ),
 *     in="path",
 *     required=true
 * )
 * 
 * @OA\Parameter(
 *     parameter="user_id",
 *     name="user_id",
 *     description="Id do usuário",
 *     @OA\Schema(
 *         type="integer",
 *     ),
 *     in="path",
 *     required=true
 * )
 * 
 * @OA\Schema(
 *     schema="EventoDeNotaFiscalStoreUpdateResponse",
 *     description="Informações que são retornadas quando há uma adição/atualização de dados de um evento",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="xml_gerado",
 *         type="string",
 *         nullable=true,
 *     ),
 *     @OA\Property(
 *         property="xml_assinado",
 *         type="string",
 *         nullable=true,
 *     ),
 * )
 * 
 * @OA\Schema(
 *     schema="DanfeStoreUpdateResponse",
 *     description="Informações que são retornadas quando há uma adição/atualização de dados de uma danfe do evento de autorização ou carta de correção",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="danfe",
 *         type="string",
 *     ),
 * ),
 * 
 * @OA\Schema(
 *     schema="EventoDeNotaFiscalRequestBody",
 *     description="Informações comuns à todas as requisições para adicionar ou atualizar eventos",
 *     @OA\Property(
 *         property="tipo_de_nota_fiscal_id",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="tipo_de_evento_id",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="status_de_processamento_id",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="aplicacao_origem_id",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="pessoa_id",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="callback",
 *         type="string",
 *     ),
 * )
 * 
 * 
 * @OA\Schema(
 *     schema="AssinaturaDeNotaFiscalRequestBody",
 *     description="Informações que são enviadas quando há uma requisição para adicionar ou atualizar um evento de assinatura de nota fiscal",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/EventoDeNotaFiscalRequestBody"),
 *         @OA\Schema(
 *             @OA\Property(
 *                 property="tag",
 *                 type="string",
 *             ),
 *             @OA\Property(
 *                 property="xml_gerado",
 *                 type="string",
 *             ),
 *             @OA\Property(
 *                 property="certificado_id",
 *                 type="integer",
 *             ),
 *         ),
 *     },
 * )
 * 
 * @OA\Schema(
 *     schema="AutorizacaoDeNotaFiscalRequestBody",
 *     description="Informações que são enviadas quando há uma requisição para adicionar ou atualizar um evento de autorização de nota fiscal",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/EventoDeNotaFiscalRequestBody"),
 *         @OA\Schema(
 *             @OA\Property(
 *                 property="xml_gerado",
 *                 type="string",
 *             ),
 *             @OA\Property(
 *                 property="certificado_id",
 *                 type="integer",
 *             ),
 *         ),
 *     }
 * )
 * 
 * @OA\Schema(
 *     schema="CancelamentoDeNotaFiscalRequestBody",
 *     description="Informações que são enviadas quando há uma requisição para adicionar ou atualizar um evento de cancelamento de nota fiscal",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/EventoDeNotaFiscalRequestBody"),
 *         @OA\Schema(
 *             @OA\Property(
 *                 property="certificado_id",
 *                 type="integer",
 *             ),
 *             @OA\Property(
 *                 property="tipo_ambiente",
 *                 type="integer",
 *             ),
 *             @OA\Property(
 *                 property="chave_da_nota",
 *                 type="string",
 *             ),
 *             @OA\Property(
 *                 property="justificativa",
 *                 type="string",
 *             ),
 *             @OA\Property(
 *                 property="numero_protocolo",
 *                 type="string",
 *             ),
 *         )
 *     }
 * )
 * 
 * @OA\Schema(
 *     schema="CartaDeCorrecaoDeNotaFiscalRequestBody",
 *     description="Informações que são enviadas quando há uma requisição para adicionar ou atualizar um evento de carta de correção de nota fiscal",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/EventoDeNotaFiscalRequestBody"),
 *         @OA\Schema(
 *             @OA\Property(
 *                 property="certificado_id",
 *                 type="integer",
 *             ),
 *             @OA\Property(
 *                 property="tipo_ambiente",
 *                 type="integer",
 *             ),
 *             @OA\Property(
 *                 property="chave_da_nota",
 *                 type="string",
 *             ),
 *             @OA\Property(
 *                 property="correcao",
 *                 type="string",
 *             ),
 *         )
 *     }
 * )
 * 
 * @OA\Schema(
 *     schema="InutilizacaoDeNotaFiscalRequestBody",
 *     description="Informações que são enviadas quando há uma requisição para adicionar ou atualizar um evento de inutilização de nota fiscal",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/EventoDeNotaFiscalRequestBody"),
 *         @OA\Schema(
 *             @OA\Property(
 *                 property="certificado_id",
 *                 type="integer",
 *             ),
 *             @OA\Property(
 *                 property="tipo_ambiente",
 *                 type="integer",
 *             ),
 *             @OA\Property(
 *                 property="numero_serie",
 *                 type="string",
 *             ),
 *             @OA\Property(
 *                 property="numero_inicial",
 *                 type="string",
 *             ),
 *             @OA\Property(
 *                 property="numero_final",
 *                 type="string",
 *             ),
 *             @OA\Property(
 *                 property="justificativa",
 *                 type="string",
 *             ),
 *             @OA\Property(
 *                 property="codigo_uf",
 *                 type="integer",
 *             ),
 *         )
 *     }
 * )
 * 
 * @OA\Schema(
 *     schema="ManifestacaoDeNotaFiscalRequestBody",
 *     description="Informações que são enviadas quando há uma requisição para adicionar ou atualizar um evento de manifestação de nota fiscal",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/EventoDeNotaFiscalRequestBody"),
 *         @OA\Schema(
 *             @OA\Property(
 *                 property="certificado_id",
 *                 type="integer",
 *             ),
 *             @OA\Property(
 *                 property="tipo_ambiente",
 *                 type="integer",
 *             ),
 *             @OA\Property(
 *                 property="chave_da_nota",
 *                 type="string",
 *             ),
 *             @OA\Property(
 *                 property="tipo_de_mensagem",
 *                 type="integer",
 *             ),
 *             @OA\Property(
 *                 property="justificativa",
 *                 type="string",
 *             )
 *         )
 *     }
 * )
 * 
 * @OA\Schema(
 *     schema="ValidacaoDeNotaFiscalRequestBody",
 *     description="Informações que são enviadas quando há uma requisição para adicionar ou atualizar um evento de validação de nota fiscal",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/EventoDeNotaFiscalRequestBody"),
 *         @OA\Schema(
 *             @OA\Property(
 *                 property="xml_de_origem",
 *                 type="string",
 *             ),
 *         )
 *     }
 * )
 * 
 * @OA\Schema(
 *     schema="DanfeRequestBody",
 *     @OA\Property(
 *         property="xml_origem", 
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="pessoa_id", 
 *         type="integer",
 *     ),
 * ),
 *
 *  * @OA\Schema(
 *     schema="GerarAplicativoRequestBody",
 *     @OA\Property(
 *         property="aplicacao_de_origem_id", 
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="cd_empresa_aplicacao_origem", 
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="sistema_operacional", 
 *         type="integer",
 *     ),
 * ),
 * 
 */