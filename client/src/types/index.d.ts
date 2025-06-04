export interface WordbaseResponse {
    message: string;
}

export interface AnagramWord {
    anagram: string;
}

export interface AnagramResponse {
    count: number;
    data: AnagramResult[];
}
