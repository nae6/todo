# Todo App（Laravel）

Laravelで作成したTodo管理アプリです。
ユーザー認証を前提に「自分のTodoだけ閲覧・編集できる」こと（データ分離）を重視して実装しています。

---

## 概要（できること）
- ユーザーがTodoを作成・更新・削除できる
- キーワード検索、カテゴリ検索ができる
- 未完了のみを一覧表示できる
- Todoを完了にできる（完了日時も保存）
- ログインユーザーのTodoのみ表示・検索される（他ユーザーのデータは扱えない）
- 完了済みのTodoを未完了に戻すことができる
- 完了済みのTodoを削除（物理削除）できる

---

## 想定利用シーン（業務フロー）
1. ユーザーがログインする
2. Todoを登録する（カテゴリ選択＋内容入力）
3. 一覧で未完了Todoを確認する
4. キーワード/カテゴリで絞り込み検索する
5. 必要に応じて更新する
6. 完了したら「完了」ボタンで完了状態にする（一覧から非表示になる）
7. 不要になったTodoは削除する

---

## 機能一覧

### 認証・権限
- ユーザー登録 / ログイン / ログアウト
- ログインユーザーのTodoのみ表示（`scopeForUser()`）
- 認可（Policy）
  - update：本人のみ
  - delete：本人のみ
  - viewAny：一覧アクセス

### Todo
- 作成
- 更新
- 削除
- 完了（`is_done`）
- 未完了一覧（`scopeIncomplete()`）
- 検索
  - キーワード検索（`scopeKeywordSearch()`）
  - カテゴリ検索（`scopeCategorySearch()`）

### その他
- バリデーション（`TodoRequest, CategoryRequest`）
- テスト（`TodoTest`）

---

## 技術スタック
- PHP: 8.1
- Laravel: 8.83
- DB: MySQL
- View: Blade
- Docker / docker-compose

---

## ER図

### テーブル構成
- users
- todos
- categories

### リレーション
- users (1) ─── (N) todos
- users (1) ─── (N) categories
- categories (1) ─── (N) todos

（ここに画像を貼る）
![ERD](docs/erd.png)

---

## DB設計（カラム例）

### todos
| column | type | note |
|---|---|---|
| id | bigint | PK |
| user_id | bigint | FK(users.id), index |
| category_id | bigint | FK(categories.id), index |
| content | string | Todo内容 |
| is_done | boolean | 完了フラグ |
| completed_at | datetime | 完了日時（nullable） |
| created_at / updated_at | timestamp | Laravel標準 |

---

## 工夫した点（設計・品質）

### 1. データ分離（他人のTodoが見えない）
- 一覧・検索で `scopeForUser(Auth::id())` を必ず適用
- 更新・削除はPolicyで本人のみ許可（`user_id === todo.user_id`）

### 2. 検索ロジックをローカルスコープに切り出し
- Controllerの肥大化を防ぐため、検索条件を `scopeKeywordSearch` / `scopeCategorySearch` に集約

### 3. N+1問題の対策
- 一覧取得で `with('category:id,name')` を使用してEager Loading

### 4. DB整合性
- 外部キー制約（todos.user_id / todos.category_id）
- インデックス（外部キー作成時に付与）

---

## セットアップ & 起動手順（ローカル）

### 1. リポジトリをクローン
```bash
git clone https://github.com/nae6/laravel-todo-app.git
cd laravel-todo-app
```

### 2. Dockerを起動
```bash
docker-compose up -d --build
```

### 3. PHPコンテナに入る
```bash
docker-compose exec php bash
```

### 4. Laravelパッケージのインストール
```bash
composer install
```

### 4. .env作成
```bash
cp .env.example .env
php artisan key:generate
```

### 5. DB作成・マイグレーション
```bash
php artisan migrate
php artisan db:seed
```