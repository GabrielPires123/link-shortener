# Link Shortener

Sistema de encurtamento de URLs desenvolvido com PHP e Symfony.

# Diagrama entidade relacionamento

erDiagram LINK { int id PK string original_url "URL de destino original" string code UK "Código/Hash único gerado (ex: a1b2c3)" datetime expires_at "Data/Hora de expiração (opcional)" boolean is_active "Status do link" datetime created_at "Data de criação" } HISTORY_LINK { int id PK int link_id FK "Relacionamento com a entidade LINK" string old_url "URL antiga (em caso de alteração)" string new_url "Nova URL atribuída" datetime created_at "Data da alteração/registro" datetime updated_at "Data de atualização" datetime deleted_at "Data de exclusão mágica/soft delete" } LINK ||--o{ HISTORY_LINK : "possui histórico de alterações"
