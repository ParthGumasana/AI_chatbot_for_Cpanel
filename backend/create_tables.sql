-- backend/create_tables.sql

-- Database: chatbot_saas (or whatever your cPanel database name is)

-- Table for Users
CREATE TABLE IF NOT EXISTS users (
    uid VARCHAR(128) PRIMARY KEY NOT NULL, -- This will be Laravel's user ID (UUID)
    email VARCHAR(255) UNIQUE NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table for Chatbot Configurations
CREATE TABLE IF NOT EXISTS chatbots (
    id VARCHAR(128) PRIMARY KEY NOT NULL, -- Unique ID for each chatbot
    user_id VARCHAR(128) NOT NULL,        -- Foreign key to users.uid
    name VARCHAR(255) NOT NULL,
    description TEXT,
    data_sources JSON,                    -- Store URLs/file paths as JSON array
    llm_type VARCHAR(50) NOT NULL,        -- 'LM_STUDIO' or 'OPENAI'
    openai_api_key VARCHAR(255),          -- Stored as plain text for now, consider encryption
    is_ready BOOLEAN DEFAULT FALSE,       -- True if vector store is built
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    last_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    embed_url VARCHAR(512),               -- The URL for embedding the widget
    status_message VARCHAR(255),          -- Status of data processing
    FOREIGN KEY (user_id) REFERENCES users(uid) ON DELETE CASCADE
);

-- Table for Human Handoff Requests
CREATE TABLE IF NOT EXISTS handoff_requests (
    id VARCHAR(128) PRIMARY KEY NOT NULL, -- Unique ID for each handoff request
    chatbot_id VARCHAR(128) NOT NULL,     -- Foreign key to chatbots.id
    user_id VARCHAR(128) NOT NULL,        -- The Laravel user ID (owner of the chatbot)
    user_name VARCHAR(255),
    user_email VARCHAR(255) NOT NULL,
    user_phone VARCHAR(50),
    query_history JSON,                   -- Store chat history as JSON array of messages
    summary TEXT,
    status VARCHAR(50) DEFAULT 'pending', -- 'pending', 'resolved', 'closed'
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    resolved_at DATETIME,
    agent_notes TEXT,
    FOREIGN KEY (chatbot_id) REFERENCES chatbots(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(uid) ON DELETE CASCADE
);
