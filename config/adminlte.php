<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'TurtleGest',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Turtle</b>Gest',

    'logo_mini' => '<b>T</b>G',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | light variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'green',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we have the option to enable a right sidebar.
    | When active, you can use @section('right-sidebar')
    | The icon you configured will be displayed at the end of the top menu,
    | and will show/hide de sidebar.
    | The slide option will slide the sidebar over the content, while false
    | will push the content, and have no animation.
    | You can also choose the sidebar theme (dark or light).
    | The right Sidebar can only be used if layout is not top-nav.
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'registo',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and a URL. You can also specify an icon from Font
    | Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    */

    'menu' => [
        // [
        //     'search' => true,
        //     'href' => 'test',  //form action
        //     'method' => 'POST', //form method
        //     'input_name' => 'menu-search-input', //input name
        //     'text' => 'Search', //input placeholder
        // ],
        
      //   [
      //    'text'    => 'Ajuda',
      //    'icon' => 'fa fa-info-circle',
      //    'url'     => 'faq',
       
      //  ],
        [
            'text'    => 'Registo Diário',
            'icon' => 'fas fa-book',
            'url'     => 'registo',
            'active'    => ['/editarregisto','mostrarpontomensal','/registo','/registo*'],
          
          ],
          [
            'text' => 'Calendário',
       
            'icon'    => 'far fa-calendar-alt',
            'url'     => 'calendario',
            
         ],
         [
            'text' => 'Status Colaboradores',
            'icon'    => 'fas fa-user-check',
            'url'     => 'status',
            'active'    => ['status'],
         ],
         [
            
         'text'    => 'Colaboradores',
            'icon'    => 'fas fa-address-card',
            'url'     => 'colaboradoresall',
            'active'    => ['colaboradoresall'],
         ],





          [
            'text'    => 'Zona Pessoal',
            'icon' => 'far fa-user-circle',
            'submenu' => [
                [
                    'text' => ' Perfil',
                    'icon'    => 'fas fa-user',
                    'url'     => 'perfil',
                    'active'    => ['/perfil*'],
               
                 ],
               
                 [
                    'text' => 'Mensagens',
                    'icon'    => 'fas fa-envelope',
                    'url'  => 'chat',
                 ],
                 [
                    'text' => 'Notícias',
                    'icon'    => 'fas fa-newspaper',
                    'url'     => 'noticia',
                    'active'    => ['noticia','criarnoticia','editnoticias'],
                
                 ],
                 [
              
                    'text' => 'Correspondência',
                    'icon'    => 'fas fa-mail-bulk',
                    'url'     => 'correspondencias',
                    'active'    => ['correspondencias','correspondencianova'],
                
                 ],
                 [
             
                  'text' => 'Formações',
                  'icon'    => 'fas fa-chalkboard-teacher',
                  'url'     => 'minhaformacao',
             
                  ],
                ],
      
          ],


        ['header' => 'main_navigation'],
        // [
        //     'text' => 'blog',
        //     'url'  => 'admin/blog',
        //     'can'  => 'manage-blog',
        // ],
        // [
        //     'text'        => 'pages',
        //     'url'         => 'admin/pages',
        //     'icon'        => 'far fa-file',
        //     'label'       => 4,
        //     'label_color' => 'success',
        // ],

        // ['header' => 'Gestão'],

    
        
        [

            'text'    => 'Gestão',
            'icon'    => 'fas fa-cogs',
            'can'     => 'administrador',
            'submenu' => [ [
              
                'text' => 'Dashboard',              
                'icon'    => 'fas fa-tachometer-alt',
                'url'     => 'dashboard',
                'active'    => ['dashboard','relatoriodia'],
            
             ],

                [
                    'text'    => 'Empresa',
                    'icon'    => 'far fa-building',
                    'submenu' => [
                        
                            [
                                'text' => 'Ver Empresa',
                                'icon'    => 'fas fa-eye',
                                'url'     => 'empresas',
                             ],
                            
                            
                          
                            [
                            'text' => 'Cargos',
                            'icon'    => 'fas fa-user-graduate',
                            'submenu' => [
                                [
                                    'text' => 'Ver Cargos',
                                    'icon'    => 'fas fa-eye',
                                    'url'     => 'cargos',
                                 ],
                                 [
                                    'text' => 'Criar Cargo',
                                    'icon'    => 'fas fa-plus-circle',
                                    'url'  => 'novocargo',
                                 ],
                                //  [
                                                            
                                //     'text' => 'Editar Cargo',
                                //     'icon'    => 'far fa-edit',
                                //     'url'     => '/cargos',
                                //     'active'    => ['/editarcargo/*'],
                                    
                                //  ],
                              
                                ],

               
                            ],
                            [
                            'text' => 'Departamentos',
                            'icon'    => 'fas fa-users',
                            'submenu' => [
                            
                                                [
                                                    'text' => 'Ver Departamentos',
                                                    'icon'    => 'fas fa-eye',
                                                    'url'     => 'departamentos',
                                                 ],
                                                 [
                                                    'text' => 'Criar Departamento',
                                                    'icon'    => 'fas fa-plus-circle',
                                                    'url'  => 'novodepartamento',
                                                 ],
                                          
                                              
                                               
                                            
                                           
                                       
                                    ],
                                
                            ],
                               
                        ],
                    
                ],

                    
                
                [
                    'text'    => 'Colaboradores',
                 
                    'icon' => 'fas fa-address-card',
                    'submenu' => [
                        [
                            'text' => 'Gerir Colaboradores',
                            'icon'    => 'fas fa-user-friends',

                            'submenu' => [
                                [
                                    'text' => 'Colaboradores',
                                    'icon'    => 'fas fa-eye',
                                    'url'     => 'colaboradors',
                                    'active'    => ['colaboradors','/veruser/*'],
                                 ],
                              
                                 [
                                    'text' => 'Criar Colaborador',
                                    'icon'    => 'fas fa-plus-circle',
                                    'url'  => 'novouser',
                                 ],
                            
                              
                                ],
                        
                         ],

                         [
                            'text' => 'Horários',
                            'icon'    => 'far fa-clock',

                            'submenu' => [
                                [
                                    'text' => 'Ver Horários',
                                    'icon'    => 'fas fa-eye',
                                    'url'     => 'horarios',
                                    'active'    => ['/editarhorario/*','/horarios'],
                                 ],
                                 [
                                    'text' => 'Criar Horários',
                                    'icon'    => 'fas fa-plus-circle',
                                    'url'  => 'novohorario',
                                 ],
                               
                              
                                ],
                        
                         ],
                        ],
              
               ],
               [
              
                  'text' => 'Sobre',              
                  'icon'    => 'fas fa-file-contract',
                  'url'     => 'licenciamento',
                  'active'    => ['licenciamento'],
              
               ],
               
                
                
        ],
     
        
        
    ],
    // segundo 

      [
        'text'    => 'Projetos',
        'icon' => 'fas fa-hard-hat',
         'submenu' => [
            [
                'text' => 'Gerir Projetos',
                'icon'    => 'fas fa-hard-hat',
                'submenu' => [
                    [
                        'text' => 'Ver Projetos',
                        'icon'    => 'fas fa-eye',                       
                        'url'     => '/projetos',
                        'active'    => ['projetos','/verprojeto/*'],
 
                     ],
                     [
                        'text' => 'Criar Projeto',
                        'icon'    => 'fas fa-plus-circle',
                        'url'     => '/novoprojeto',
                     ],

            
                    //  [
                                        
                    //     'text' => 'Editar Projeto',
                    //     'icon'    => 'far fa-edit',
                    //     'url'     => '/projetos',
                    //     'active'    => ['/editarprojeto/*'],
                        
                    //  ],
                     [
                        'text' => 'Configurações',
                        'icon'    => 'fas fa-wrench',
                        'submenu' => [
                            [
                                'text' => 'Áreas Projetos',
                                'icon'    => 'fas fa-object-group',
                                'url'     => 'projetoarea',
                             ],
                             
                             [
                                'text' => 'Urgências Projetos',
                                'icon'    => 'fas fa-layer-group',
                                'url'  => 'projetourgencia',
                             ],
                            ],
                  
                     ],
                    
                    ],



          
             ],
             [
                'text' => 'Proj. por Departamento',
          
                'icon'    => 'fas fa-chalkboard-teacher',
                'url'     => 'projdep',
             ],[
                'text' => 'Etapas',
                'icon'    => 'fas fa-hourglass-start',
                'submenu' => [
                    [
                        'text' => 'Ver Etapas',
                        'icon'    => 'fas fa-eye',
                        'url'     => 'etapas',
                        'active'    => ['/veretapa','etapas'],
                        
                     ],
                     [
                        'text' => 'Criar Etapas',
                        'icon'    => 'fas fa-plus-circle',
                        'url'     => 'novaetapa',
                     ],
                    ],
             ],
             [
                'text' => 'Intervenções',
                'icon'    => 'fas fa-hammer',
                'submenu' => [
                    [
                        'text' => 'Ver Intervenções',
                        'icon'    => 'fas fa-eye',
                        'url'     => 'intervencoes',
                     ],
                    ],
             ],

            
            ],
  
      ],
      

      [
        'text'    => 'Orçamentos',
        'icon' => 'fas fa-calculator',
        'can' =>'administrador',
        'submenu' => [




         
            [
                'text' => 'Orçamentos',
                'icon'    => 'fas fa-calculator',
                'url'     => 'orcamentos',
                'active'    => ['/novoorcamento','/orcamentos','editarorcamento','verorcamento'],

                
             ],
            
             [
               'text'=>'Configurações',
               'icon'=>'fas fa-wrench',
               'submenu' => [
                  [
                      
                     'text' => ' Prazos',
                     'icon'    => 'fas fa-hourglass-start',
                     'url'     => 'prazosorcamento',
                     'active'    => ['/prazosorcamento','/criarprazo'],

                     
                  ],
                  [
                                             
                    'text' => ' Tipos Orçamento',
                    'icon'    => 'fas fa-map-pin',
                  
                    'url'     => 'tiposorcamento',
                    'active'    => ['/tiposorcamento','criartipoorcamento','editartipo'],

                    
                 ],
                
               
               ],
             ],
          
            ],
        ],
        [
         'text'    => ' CRM',
         'icon' => 'far fa-handshake',
      
         'submenu' => [
 
             [
                 'text' => 'Gestão',
                 'icon'    => 'fas fa-assistive-listening-systems',
                
                 
                 'submenu' => [
                  [
                     'text'    => 'Clientes',
                     'icon' => 'far fa-handshake',
                     'url'     => 'clientes',
                     'active'    => ['clientes','/vercliente/*','novocliente','client'],
                  ],
                     [
                     'text' => 'RGPD',
                     'icon'    => 'fas fa-fingerprint',
                     'url'  => 'rgpdcliente',
                    ],
               
                  
 
                 ],
            
              ],
 
             [
                 'text' => 'Comercial',
                 'icon'    => 'fas fa-comments-dollar',
                 'submenu' => [
                     [
                         'text' => ' Potênciais Clientes',
                         'icon'    => 'fas fa-hands-helping',
                         'url'     => 'potencialcliente',
                         'active'    => ['/potencialcliente','/newpotencialcliente','/verpotencialcliente','/editpotencialcliente','converterpotencialcliente','verpotencialclientelead'],
                      ],
                      [
                        'text' => ' Leads',
                        'icon'    => 'fas fa-bookmark',
                   
                        'url'  => 'leads',
                        'active'    => ['/leads','newlead','editlead'],
                     ],
                     [
                                                      
                        'text' => ' Contactos com Clientes',
                        'icon'    => 'fas fa-bullhorn',
                        'url'     => 'contactosComClientes',
                        'active'    => ['/contactosComClientes','newcontactosComClientes'],

                        
                     ],
                      [
                        'text'=>'Configurações',
                        'icon'=>'fas fa-wrench',
                        'submenu' => [
                           [
                                                 
                              'text' => ' Campanhas',
                              'icon'    => 'fas fa-bullhorn',
                              'url'     => 'campanha',
                              'active'    => ['/campanha','/tipocampanha', '/editartipocampanha','/editcampanha','/novacampanha','/newtipocampanha'],
     
                              
                           ],
                           [
                                                      
                             'text' => ' Origem',
                             'icon'    => 'fas fa-bullhorn',
                             'url'     => 'origem',
                             'active'    => ['/origem'],
     
                             
                          ],
                          [
                                                      
                           'text' => ' Tipo de Contacto',
                           'icon'    => 'fas fa-bullhorn',
                           'url'     => 'tipocontacto',
                           'active'    => ['/tipocontacto','tipocontactocriar'],
   
                           
                        ],
                        
                        ],
                      ],
                     
 
                 ],
             ],
            
           
             ],
       ],

            [
                'text'    => 'RH',
                'icon' => 'fas fa-users',
                'can'=>'rh-adminstracao',
                'submenu' => [
                    [
                        'text' => 'Colaboradores',
                        'icon'    => 'fas  fa-users',
                        'submenu' => [
                            [
                                'text' => 'Colaboradores',
                                'icon'    => 'fas fa-eye',
                                'url'     => 'colaboradores',
                                'active'    => ['colaboradores'],
                             ],
                             [
                              'text' => 'Colaboradores Arquivo',
                              'icon'    => 'fas fa-eye',
                              'url'     => 'colaboradorarquivo',
                              'active'    => ['colaboradorarquivo'],
                           ],
                             [
                                'text' => 'Criar Colaborador',
                                'icon'    => 'fas fa-plus-circle',
                                'url'  => 'criarcolaborador',
                             ],
                        
                        
                            ],
                     ],
                     [
                        'text' => 'Cargos',
                        'icon'    => 'fas fa-user-graduate',
                        'submenu' => [
                            [
                                'text' => 'Ver Cargos',
                                'icon'    => 'fas fa-eye',
                                'url'     => 'cargos',
                                'active'    => ['cargos','editarcargo/*'],

                             ],
                             [
                                'text' => 'Criar Cargo',
                                'icon'    => 'fas fa-plus-circle',
                                'url'  => 'novocargo',
                             ],
                            ],
                        ],
                       
                         [
                            'text' => 'Horários',
                            'icon'    => 'far fa-clock',

                            'submenu' => [
                                [
                                    'text' => 'Ver Horários',
                                    'icon'    => 'fas fa-eye',
                                    'url'     => 'horarios',
                                    'active'    => ['/editarhorario/*','/horarios'],
                                 ],
                                 [
                                    'text' => 'Paragens Empresa',
                                    'icon'    => 'fas fa-stopwatch',
                                    'url'  => 'paragens',
                                    'active'    => ['/paragens','/adicionardiaparagem'],
                                 ],
                       
                              
                                ],
                        
                         ],
                         [
                            'text' => 'Departamentos',
                            'icon'    => 'fas fa-users',
                            'submenu' => [
                            
                                                [
                                                    'text' => 'Ver Departamentos',
                                                    'icon'    => 'fas fa-eye',
                                                    'url'     => 'departamentos',
                                                 ],
                                                 [
                                                    'text' => 'Criar Departamento',
                                                    'icon'    => 'fas fa-plus-circle',
                                                    'url'  => 'novodepartamento',
                                                 ],
                                          
                                              
                                               
                                            
                                           
                                       
                                    ],
                                
                            ],


                  
                     [
                        'text' => 'Consultar Registo Diário',
                        'icon' => 'fas fa-book',
                        'url'     => 'consultarregistodiario',
                        'active'    => ['consultarregistodiario'],
                     ],
                     [
                        'text' => 'Registos Ponto',
                        'icon'    => 'far fa-clock',
                        'submenu' => [
                            [
                                'text' => 'Relatório Ponto',
                                'icon'    => 'fas fa-eye',
                                'url'     => 'relatorioponto',
                                'active'    => ['relatorioponto','mostrarpontomensal'],
                             ],
                             [
                                'text' => 'Mostrar Processamento',
                                'icon'    => 'fas fa-balance-scale',
                                'url'     => 'processamento',
                               
                             ],
                             [
                                'text' => 'Aprovar Ponto',
                                'icon'    => 'fas fa-thumbs-up',
                                'url'     => 'aprovarpontos',
                               
                             ],

                             [
                              'text' => 'Aprovar Ponto Histórico',
                              'icon'    => 'fas fa-thumbs-up',
                              'url'     => 'aprovarpontoshistorico',
                             
                           ],



                             
                             [
                                'text' => 'Editar Ponto',
                                'icon'    => 'far fa-edit',
                                'url'     => 'editarresgistos',
                                // 'active'    => ['clientes','/vercliente/*'],
                             ],
                             
                             
                             
                     ],
                    ],
                  
                    
                    [
                        'text' => 'Ausências',
                        'icon'    => 'fas fa-umbrella-beach',
                        'submenu' => [
                    
                     [
                        'text' => 'Marcar Ausências',
                        'icon'    => 'fas fa-sign-out-alt',
                        'url'     => 'marcarausencia',
                   
                     ],
                     [
                        'text' => 'Mostrar Ausências',
                        'icon'    => 'fas fa-sign-out-alt',
                        'url'     => 'mostrarausencias',
                   
                     ],
                     [
                        'text' => 'Férias',
                        'icon'    => 'fas fa-umbrella-beach',
                        'url'     => 'ferias',
                   
                     ],
                    ],
                ],

                     [
                        'text' => 'Notícias',
                        'icon'    => 'fas fa-newspaper',
                        'url'     => 'noticias',
                        'active'    => ['noticias','criarnoticia','editnoticias'],
                    
                     ],
                     [
                        'text'    => ' Medicina No Trabalho',
                        'icon' => 'fas  fa-heartbeat',
             
                        'url' => 'medicina'

                
                        ],
                        [
                           'text'    => 'Formações',
                           'icon' => 'fas fa-chalkboard-teacher',
                
                           'url' => 'formacao',
                           'active'    => ['formacao','newformacao','inscricao'],

                   
                           ],
                        
              ],
             
  
      ],
      [
        'text'    => ' Requisições',
        'icon' => 'fas fa-map',
     
        'submenu' => [

            [
                'text' => 'Registo Requisições',
                'icon'    => 'fas fa-sign-out-alt',
                
                'submenu' => [
                    [
                        'text' => ' Veículos',
                        'icon'    => 'fas fa-car',
                        'url'     => 'requisicoescarro',
                        'active'    => ['/requisicoescarro','requisitarcarro','requisicaocarrover' ],
                     ],
                     [
                        'text' => ' Salas',
                        'icon'    => 'fas fa-person-booth',
                        'url'  => 'requisicoessala',
                        'active'    => ['/requisicoessala','novosala' ],
                     ],
                     [
                                                
                        'text' => ' Equipamentos',
                        'icon'    => 'fas fa-laptop',
                        'url'     => 'requisicoesequipamento',
                        'active'    => ['/requisicoesequipamento','requisitarequipamento'],
                        
                     ],

                ],
           
             ],

            [
                'text' => 'Imobilizado',
                'icon'    => 'fas fa-user-graduate',
                'submenu' => [
                    [
                        'text' => ' Veículos',
                        'icon'    => 'fas fa-car',
                        'url'     => 'veiculos',
                        'active'    => ['/veiculos','novoveiculo','editarveiculo'],
                     ],
                     [
                        'text' => ' Salas',
                        'icon'    => 'fas fa-person-booth',
                         'url'  => 'salas',
                        'active'    => ['/salas'],
                     ],
                     [
                                                
                        'text' => ' Equipamentos',
                        'icon'    => 'fas fa-laptop',
                        'url'     => 'equipamentos',
                        'active'    => ['/equipamentos', 'novoequipamento','editarequipamento','criarmanutencao','equipamentover'],
                        
                     ],

                ],
            ],
           
          
            ],
      ],

      [
         'text'    => 'Logística',
         'icon' => 'fas fa-box-open',
      
      
         'submenu' => [
 
             [
                 'text' => 'Armazéns',
                 'icon'    => 'fas fa-warehouse',
                 'url'     => 'armazens',
                 'active'    => ['/armazens','novoarmazem','editararmazem','inventario' ],
               
            
              ],
 
             [
                 'text' => 'Artigos',
                 'icon'    => 'fas fa-boxes',
                 'submenu' => [
                     [
                         'text' => ' Artigos',
                         'icon'    => 'fas fa-box-open',
                         'url'     => 'artigos',
                         'active'    => ['/artigos','novoartigo','editarartigo','artigover'],
                      ],
                      [
                         'text' => ' Família Artigos',
                         'icon'    => 'fas fa-network-wired',
                         'url'  => 'familiaartigo',
                         'active'    => ['/novofamiliaartigo','familiaartigo' ],
                      ],
                  
 
                 ],
             ],
             [
               'text' => 'Encomendas',
               'icon'    => 'fas fa-shopping-cart',
               'url'     => 'compras',
               'active'    => ['/compras','novocompra','editarcompra','mostrarcompra'],
            
            ],
            [
               'text' => 'Iva',
               'icon'    => 'fas fa-percent',
               'url'     => 'ivas',
               'active'    => ['/ivas','novoiva','editariva','inventario' ],
             
          
            ],
            [
               'text' => 'Vendas',
               'icon'    => 'fas fa-euro-sign',
               'url'     => 'vendas',
               'active'    => ['/vendas','novovenda','editarcompra','mostrarvenda'],
                   
               
            ],
            [
               'text' => 'Fornecedores',
               'icon'    => 'fas fa-user-tie',
               'url'     => 'fornecedores',
               'active'    => ['/fornecedores','novofornecedor','editarfornecedores','fornecedorshow'],
             
            ],
           
             ],
      
      ],

      [
         'text'    => 'Qualidade',
         'icon' => 'fas fa-exclamation-circle',
      
      
         'submenu' => [
 
             [
                 'text' => 'Ocorrências',
                 'icon'    => 'fas fa-pen-alt',
                 'url'     => '/ocorrencias',
                 'active'    => ['ocorrencias','novaocorrencia','ocorrencia/guardar_ocorrencia','show_ocorrencia','edit_ocorrencia' ],


              ],
 
            
             [
               'text' => 'Não Conformidades',
               'icon'    => 'fas fa-exclamation',
               'url'     => 'compras',
               'active'    => ['/compras','novocompra','editarcompra','mostrarcompra'],
            
            ],
           
           
             ],
      
      ],
     
   
        
               
              
               
           
        // ['header' => 'labels'],
        // [
        //     'text'       => 'important',
        //     'icon_color' => 'red',
        // ],
        // [
        //     'text'       => 'warning',
        //     'icon_color' => 'yellow',
        // ],
        // [
        //     'text'       => 'information',
        //     'icon_color' => 'aqua',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Configure which JavaScript plugins should be included. At this moment,
    | DataTables, Select2, Chartjs and SweetAlert are added out-of-the-box,
    | including the Javascript and CSS files from a CDN via script and link tag.
    | Plugin Name, active status and files array (even empty) are required.
    | Files, when added, need to have type (js or css), asset (true or false) and location (string).
    | When asset is set to true, the location will be output using asset() function.
    |
    */

    'plugins' => [
        [
            'name' => 'Datatables',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css',
                ],
            ],
        ],
        [
            'name' => 'Select2',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        [
            'name' => 'Chartjs',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        [
            'name' => 'Sweetalert2',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        // [
        //     'name' => 'Pace',
        //     'active' => true,
        //     'files' => [
        //         [
        //             'type' => 'css',
        //             'asset' => false,
        //             'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
        //         ],
        //         [
        //             'type' => 'js',
        //             'asset' => false,
        //             'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
        // //         ],
        //     ],
        // ],
    ],
];
