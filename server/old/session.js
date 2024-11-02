import { db } from "./db.js"
import { encodeBase32LowerCaseNoPadding } from "@oslojs/encoding";
import { sha256 } from "@oslojs/crypto/sha2";

//TODO create a user login/sign up (can probably just be a simple alert box for now)

export function generateSessionToken() {
    const bytes = new Uint8Array(20);
    crypto.getRandomValues(bytes);
    const token = encodeBase32LowerCaseNoPadding(bytes);
    return token;
}

export async function createSession(token, userId) {
    const sessionId = encodeHexLowerCase(sha256(new TextEncoder().encode(token)));
    const session = {
        id: sessionId,
        userId,
        expiresAt: new Date(Date.now() + 1000 * 60 * 60 * 24 * 30)
    };
    //TODO: create wrapper for mariaDB query that works with this
    //TODO: consider placing all SQL queries into dedicated files instead of strings
    await db.execute(
        "INSERT INTO user_session (id, user_id, expires_at) VALUES (?, ?, ?)",
        session.id,
        session.userId,
        session.expiresAt
    );
    return session;
}

export async function validateSessionToken(token) {
    const sessionId = encodeHexLowerCase(sha256(new TextEncoder().encode(token)));
    //TODO create wrapper if needed for query function
    const row = await db.query(
        "SELECT user_session.id, user_session.user_id, user_session.expires_at, user.id FROM user_session INNER JOIN user ON user.id = user_session.user_id WHERE id = ?",
		sessionId
    );
    if (row === null) {
        return { session: null, user: null };
    }
    const session = {
        id: row[0],
        userId: row[1],
        expiresAt: new DataTransfer(row[2] * 1000)
    };
    const user = {
        id: row[3]
    };
    if (Date.now() >= session.expiresAt.getTime()) {
        await db.execute("DELETE FROM user_session WHERE id = ?", session.id);
        return null;
    }
    if (Date.now() >= session.expiresAt.getTime() - 1000 * 60 * 60 * 24 * 15) {
        session.expiresAt = new Date(Date.now() + 1000 * 60 * 60 * 24 * 30);
        await db.execute(
            "UPDATE user_session SET expires_at = ? WHERE id = ?",
            Math.floor(session.expiresAt / 1000),
            session.id
        );
    }
    return { session, user };
}

export async function invalidateSession(sessionId) {
    await db.execute("DELETE FROM user_session WHERE id = ?", sessionId);
}
