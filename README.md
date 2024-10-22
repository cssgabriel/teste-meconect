## Estrutura Banco de Dados

- Tabela **users**
```sql
CREATE TABLE users (user_id TEXT PRIMARY KEY, name TEXT, email TEXT, password TEXT, is_admin INT, created_at TEXT, updated_at TEXT);
```

- Tabela **markets**
```sql
CREATE TABLE markets (market_id TEXT PRIMARY KEY, name TEXT, address TEXT, owner_id TEXT, FOREIGN KEY(owner_id) REFERENCES users(user_id));
```

- Tabela **products**
```sql
CREATE TABLE products (product_id TEXT PRIMARY KEY, name TEXT, brand TEXT, category TEXT, price TEXT, discount TEXT, image_src TEXT, market_name TEXT, market_id TEXT NOT NULL, FOREIGN KEY(market_id) REFERENCES markets(market_id));
```